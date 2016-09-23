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

		function retornaSalas($Bloco){
			$sql="SELECT ID_SALA,ID_ANDAR FROM SALA, BLOCO WHERE SALA.ID_BLOCO=BLOCO.ID_BLOCO AND '".$Bloco."'=BLOCO.NOME_BLOCO";
			$result=$this->conn->query($sql);
				while($row = $result->fetch_assoc()) {
     				 echo '<option value="'.$row["ID_ANDAR"].$row["ID_SALA"].'" class="dropdown-contet">'.$row["ID_ANDAR"].$row["ID_SALA"].'</option>';
    			}	
		}
	
}

?>