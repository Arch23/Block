<?php
	class UserDAO{
		public $conn;	

		function conectaBanco(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname="roomz";

		// Create connection
		$conn = new mysqli($servername, $username, $password,$dbname);

		// Check connection
			if ($conn->connect_error) {
    			die("Connection failed: " . $conn->connect_error);
			} 
		echo "Connected successfully\n";
		return $conn;
		}

		function __construct(){
			$this->conn=$this->conectaBanco();
		}

		function insereUsuario($COD_USUARIO,$NOME_USUARIO,$EMAIL_USUARIO,$SIGLA_DEPARTAMENTO,$TIPO_USUARIO,$KEY_USER){
			$sql= "INSERT INTO USUARIO VALUES ($COD_USUARIO,'$NOME_USUARIO','$EMAIL_USUARIO','$SIGLA_DEPARTAMENTO','$TIPO_USUARIO','$KEY_USER')";
			echo $sql;

			if ($this->conn->query($sql) === TRUE) {
    			echo "New record created successfully";
			}else{
    			echo "Error: " . $sql . "<br>" . $this->conn->error;
    		}

		}
	}
		$obj = new UserDAO();
		$obj->insereUsuario(123456,"GABRIEL","EMAIL@MAIL.COM","DACOM","ALUNO","123456");
	?>