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
        function selectUser(){ //Função para retornar o ususário
                    $result=$this->conn->query("SELECT * FROM $this->username"."view");
                    return $result;                    
        }
        
        function retornaDepts(){ //Retorna os departamentos
            $result=$this->conn->query("SELECT SIGLA_DEPARTAMENTO FROM DEPARTAMENTO");
            while($row=$result->fetch_assoc()){
                echo '<option value="'.$row["SIGLA_DEPARTAMENTO"].'">'.$row["SIGLA_DEPARTAMENTO"].'</option>';
            }
        }

        function retornaTipos(){ //Retorna os tipos de usuário
            $result=$this->conn->query("SELECT TIPO_USUARIO FROM TIPO_USUARIO");
            while($row=$result->fetch_assoc()){
            echo '<option value="'.$row["TIPO_USUARIO"].'">'.$row["TIPO_USUARIO"].'</option>';
            }
        }
        function retornaNomeUser(){
            $nomeuser="???";
            $result=$this->conn->query("SELECT NOME_USUARIO FROM $this->username"."view");
            while($row=$result->fetch_assoc()){
            $nomeuser=$row["NOME_USUARIO"];
            }
            return $nomeuser;
        }
        function retornaReservasUser(){
            $cont=0;
            $coduser=substr($this->username, 1); //Retira o a do nome de usuário
            $result=$this->conn->query("SELECT * FROM RESERVA WHERE COD_USUARIO_RESERVA=$coduser AND DATA_RESERVA>='".date("Y-m-d")."'");
            while($row=$result->fetch_assoc()){
            $cont++;         
            echo' <div id="Reserva'.$cont.'"class="panel panel-default">
                    <div class="panel-heading">
                        <h3 id="Reserva'.$cont.'sala" class="panel-title">Sala reservada:'.$row["ID_BLOCO_RESERVA"].$row["ID_ANDAR_RESERVA"].$row["ID_SALA_RESERVA"].'</h3>
                  </div>
                  <div  class="panel-body">
                    <p id="Reserva'.$cont.'data" class="data-reserva">Data:'.$row["DATA_RESERVA"].'</p>
                    <p id="Reserva'.$cont.'horario" class="hora-reserva">Horário:'.$row["HORARIO_ID_HORARIO"].'</p>
                    <button id="Reserva'.$cont.'" class="round-button"> X</button>
                </div>
        </div>';
            }
        }
	}				
	?>