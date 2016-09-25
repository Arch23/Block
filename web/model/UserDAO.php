<?php
	class UserDAO{ //Classe para a conexão e criação(cadastro de um usuário)
                public $conn; //Conexão do usuário
                public $username;

		function conectaBanco($servername,$username,$password,$dbname){ 
			$conn = new mysqli($servername, $username, $password,$dbname);                       
			return $conn;
		}
                
        function __construct($servername,$username,$password,$dbname) { //Cria a conexão ao   instanciar a classe
            $this->conn=$this->conectaBanco($servername,$username,$password,$dbname);
                $this->username=$username;
        }


		function insereUsuario($COD_USUARIO,$NOME_USUARIO,$EMAIL_USUARIO,$SIGLA_DEPARTAMENTO,$TIPO_USUARIO,$KEY_USER,$USUARIO_SENHA){//Função para inserção de usuário
            $result=$this->conn->query("SELECT COD_USUARIO FROM USUARIO WHERE COD_USUARIO=$COD_USUARIO");                       
            if($result->num_rows >0){
                return 2;
            }                     
			//Insere os Usuários na tabela de usuário
			$sqltb= "INSERT INTO USUARIO VALUES ($COD_USUARIO,'$NOME_USUARIO','$EMAIL_USUARIO','$SIGLA_DEPARTAMENTO','$TIPO_USUARIO','$KEY_USER')";
			//Cria o usuário no banco
			$sqluser="CREATE USER 'a$COD_USUARIO'@'localhost' IDENTIFIED BY '$USUARIO_SENHA'";
			//Cria a visão do usuário no banco 
			$sqlview="CREATE VIEW a$COD_USUARIO"."view AS SELECT * FROM USUARIO WHERE COD_USUARIO='$COD_USUARIO'";
			//Concede permição de select e update na visão para o usuário
			$sqluserview="GRANT SELECT,UPDATE ON Roomz.a$COD_USUARIO"."view TO 'a$COD_USUARIO'@'localhost'";
            //Concede permissão de select na tabela de reservas fixas
            $sqlreservaview="GRANT SELECT ON Roomz.RESERVA_NORMAL TO 'a$COD_USUARIO'@'localhost'";
            //Concede permissão de select, insert,update,delete na tabela de reservas  extraordinárias
            $sqlreserva1view="GRANT SELECT,INSERT,UPDATE,DELETE ON Roomz.RESERVA TO 'a$COD_USUARIO'@'localhost'";
            //Concede permissão de visão na lista de salas
            $sqlsalaview="GRANT SELECT ON Roomz.SALA TO 'a$COD_USUARIO'@'localhost'";
            //Concede permissão de select na lista de andares  
            $sqlblocoview="GRANT SELECT ON Roomz.ANDAR TO 'a$COD_USUARIO'@'localhost'";
            //Concede permissão de select na lista de blocos
            $sqlandarview="GRANT SELECT ON Roomz.BLOCO TO 'a$COD_USUARIO'@'localhost'";

            //Se todas as queryes forem realizadas com sucesso o usuário então é criado
			if ($this->conn->query($sqltb) === TRUE && $this->conn->query($sqluser)==TRUE && $this->conn->query($sqlview)==TRUE && $this->conn->query($sqluserview)
                && $this->conn->query($sqlreservaview) === TRUE && $this->conn->query($sqlreserva1view)==TRUE && $this->conn->query($sqlsalaview)==TRUE
                && $this->conn->query($sqlblocoview)==TRUE && $this->conn->query($sqlandarview)==TRUE ) {
    			echo "Usuário Criado com sucesso";
                return 1;
				}else{  //Caso hajam erros o usuário é removido
                    $this->conn->query("DELETE FROM USUARIO WHERE COD_USUARIO='$COD_USUARIO'");
                    $this->conn->query("DROP VIEW a$COD_USUARIO"."view IF EXISTS");
                    $this->conn->query("DROP USER a$COD_USUARIO"."@localhost IF EXISTS");
                    return -1;
                        
    			}
		}
                function selectUser(){ //Função para retornar oo ususário
                    $result=$this->conn->query("SELECT * FROM $this->username"."view");
                    return $result;                    
                }               

	}				
	?>