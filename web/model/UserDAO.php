<?php
	class UserDAO{
                public $conn;
                public $username;

		function conectaBanco($servername,$username,$password,$dbname){
			$conn = new mysqli($servername, $username, $password,$dbname);                       
			return $conn;
		}
                
                function __construct($servername,$username,$password,$dbname) {
                    $this->conn=$this->conectaBanco($servername,$username,$password,$dbname);
                    $this->username=$username;
                }

		//Fazer oo Login através do construtor, se for utilizar o root passar como parametros "localhost","root","sua senha do banco","roomz

		function insereUsuario($COD_USUARIO,$NOME_USUARIO,$EMAIL_USUARIO,$SIGLA_DEPARTAMENTO,$TIPO_USUARIO,$KEY_USER,$USUARIO_SENHA){
                        $result=$this->conn->query("SELECT COD_USUARIO FROM USUARIO WHERE COD_USUARIO=$COD_USUARIO");                       
                        if($result->num_rows >0){
                             return 2;
                        }                     
			//Insere os Usuários na tabela de usuário
			$sqltb= "INSERT INTO USUARIO VALUES ($COD_USUARIO,'$NOME_USUARIO','$EMAIL_USUARIO','$SIGLA_DEPARTAMENTO','$TIPO_USUARIO','$KEY_USER')";
			//Cria o usuário no banco
			$sqluser="CREATE USER 'a$COD_USUARIO'@'localhost' IDENTIFIED BY '$USUARIO_SENHA'";
			//Cria a visão do usuário no banco, Mysql zoado salva a visão como um tabela wtf
			$sqlview="CREATE VIEW a$COD_USUARIO"."view AS SELECT * FROM USUARIO WHERE COD_USUARIO='$COD_USUARIO'";
			//Concede permição de select e update na visão para o usuário
			$sqluserview="GRANT SELECT,UPDATE ON Roomz.a$COD_USUARIO"."view TO 'a$COD_USUARIO'@'localhost';";
		
			if ($this->conn->query($sqltb) === TRUE && $this->conn->query($sqluser)==TRUE && $this->conn->query($sqlview)==TRUE && $this->conn->query($sqluserview)) {
    			echo "Usuário Criado com sucesso";
                                return 1;
				}else{ //Mostra possíveis erros ao  realizar a query
    			echo "Error: " . $sqltb . "<br>" . $this->conn->error;
    			echo "Error: " . $sqluser . "<br>" . $this->conn->error;
    			echo "Error: " . $sqlview. "<br>" . $this->conn->error;
    			echo "Error: " . $sqluserview . "<br>" . $this->conn->error;
                        $this->conn->query("DELETE FROM USUARIO WHERE COD_USUARIO='$COD_USUARIO'");
                        $this->conn->query("DROP VIEW a$COD_USUARIO"."view IF EXISTS");
                        $this->conn->query("DROP USER a$COD_USUARIO"."@localhost IF EXISTS");
                        return -1;
                        
    			}
		}
                function selectUser(){
                    $result=$this->conn->query("SELECT * FROM $this->username"."view");
                    return $result;                    
                }               

	}				
	?>