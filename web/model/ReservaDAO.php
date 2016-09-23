<?php
	
	class  ReservaDAO{
		public $conn;

		function __construct(){
			$servername="localhost";
			$username="root";
			$password="";
			$dbname="roomz";

			$this->conn = new mysqli($servername, $username, $password,$dbname);                 

		}

		function retornaBlocos(){
				$sql="SELECT NOME_BLOCO FROM BLOCO";
				$result=$this->conn->query($sql);
				while($row = $result->fetch_assoc()) {
       				 echo '<option value="'.$row["NOME_BLOCO"].'" class="dropdown-contet">'.$row["NOME_BLOCO"].'</option>';
    			}

		}

	}


?>