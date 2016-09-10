<?php
	class UserDAO{
		public $conn;	

		function conectaBanco($servername,$username,$password,$dbname){

		// Cria a conexão
		$conn = new mysqli($servername, $username, $password,$dbname);

		// Verifica se a conexão funcionou
			if ($conn->connect_error) {
    			die("Erro ao conectar no banco <br>" . $conn->connect_error);
			} 
		echo "Conexão realizada com sucesso <br>";
		return $conn;
		}

		//Fazer oo Login através do construtor, se for utilizar o root passar como parametros "localhost","root","sua senha do banco","roomz"
		function __construct($servername,$username,$password,$dbname){
			$this->conn=$this->conectaBanco($servername,$username,$password,$dbname);
		}


		function insereUsuario($COD_USUARIO,$NOME_USUARIO,$EMAIL_USUARIO,$SIGLA_DEPARTAMENTO,$TIPO_USUARIO,$KEY_USER,$USUARIO_SENHA){
			//Insere os Usuários na tabela de usuário
			$sqltb= "INSERT INTO USUARIO VALUES ($COD_USUARIO,'$NOME_USUARIO','$EMAIL_USUARIO','$SIGLA_DEPARTAMENTO','$TIPO_USUARIO','$KEY_USER')";
			//Cria o usuário no banco
			$sqluser="CREATE USER 'a$COD_USUARIO'@'localhost' IDENTIFIED BY '$USUARIO_SENHA'";
			//Cria a visão do usuário no banco, Mysql zoado salva a visão como um tabela wtf
			$sqlview="CREATE VIEW a$COD_USUARIO"."view AS SELECT * FROM USUARIO WHERE COD_USUARIO='$COD_USUARIO'";
			//Concede permição de select e update na visão para o usuário
			$sqluserview="GRANT SELECT,UPDATE PRIVILEGES ON Roomz.a$COD_USUARIO"."view TO 'a$COD_USUARIO'@'localhost';";
		
			if ($this->conn->query($sqltb) === TRUE && $this->conn->query($sqluser)==TRUE && $this->conn->query($sqlview)==TRUE && $this->conn->query($sqluserview)) {
    			echo "Usuário Criado com sucesso";
				}else{ //Mostra possíveis erros ao  realizar a query
    			echo "Error: " . $sqltb . "<br>" . $this->conn->error;
    			echo "Error: " . $sqluser . "<br>" . $this->conn->error;
    			echo "Error: " . $sqlview. "<br>" . $this->conn->error;
    			echo "Error: " . $sqluserview . "<br>" . $this->conn->error;
    			}
    		//print("$sqltb <br> $sqluser <br> $sqlview <br> $sqluserview"); //Usei esse print pra testar as strings

		}

	}
		//$obj=new UserDAO("localhost","root","","roomz");
		//$obj->insereUsuario(12,"GABRIEL","EMAIL@MAIL.COM","DACOM","ALUNO","12","0000");
		
		$obj = new UserDAO("localhost",$_POST['Codigo'],$_POST['Senha'],"roomz");
				
	?>