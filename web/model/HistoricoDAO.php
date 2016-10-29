<?php
	class HistoricoDAO{
		public $conn; //Conexão do usuário
		public $username;
	 	function __construct($username,$password){ //Passa username e senha do usuário quando a classe for instanciada
			$servername="localhost";
			$dbname="roomz";
			$this->username=$username;
			$this->conn = new mysqli($servername, $username, $password,$dbname); //Cria a conexão do usuário dentro da classe
		}		
		
		function retornaHistorico($datainicio,$datatermino,$bloco){
			$diai=substr($datainicio, 0,2); //Pega o dia
			$mesi=substr($datainicio,3,2); //Pega o mes
			$anoi=substr($datainicio,6,4); //Pega o ano
			$diat=substr($datatermino, 0,2); //Pega o dia
			$mest=substr($datatermino,3,2); //Pega o mes
			$anot=substr($datatermino,6,4); //Pega o ano
			$datainicio=$anoi."-".$mesi."-".$diai;
			$datatermino=$anot."-".$mest."-".$diat;
			$usuario=substr($this->username, 1);
			$result=$this->conn->query("SELECT * FROM RESERVA,BLOCO WHERE ID_BLOCO_RESERVA=ID_BLOCO AND NOME_BLOCO='$bloco' AND DATA_RESERVA BETWEEN '".$datainicio."' AND '".$datatermino."' AND  COD_USUARIO_RESERVA='$usuario' ORDER BY DATA_RESERVA,CASE WHEN HORARIO_ID_HORARIO LIKE 'M%' THEN 1 WHEN HORARIO_ID_HORARIO LIKE 'T%' THEN 2 ELSE 3 END;");
			while($row=$result->fetch_assoc()){
				echo "<tr>";
				echo "<td>".$row['DATA_RESERVA']."</td>
               		  <td>".$row['ID_BLOCO_RESERVA'].$row['ID_ANDAR_RESERVA'].$row['ID_SALA_RESERVA']."</td>
               		  <td>".$row['HORARIO_ID_HORARIO']."</td>";
               	echo "</tr>";
			}
		}

		function retornaHistoricoSalas($datainicio,$datatermino,$bloco,$sala){
			$diai=substr($datainicio, 0,2); //Pega o dia
			$mesi=substr($datainicio,3,2); //Pega o mes
			$anoi=substr($datainicio,6,4); //Pega o ano
			$diat=substr($datatermino, 0,2); //Pega o dia
			$mest=substr($datatermino,3,2); //Pega o mes
			$anot=substr($datatermino,6,4); //Pega o ano
			$datainicio=$anoi."-".$mesi."-".$diai;
			$datatermino=$anot."-".$mest."-".$diat;
			$andar=substr($sala,0,1);
			$sala=substr($sala,1);
			$usuario=substr($this->username, 1);
			$result=$this->conn->query("SELECT * FROM RESERVA,BLOCO WHERE ID_BLOCO_RESERVA=ID_BLOCO AND NOME_BLOCO='$bloco' AND DATA_RESERVA BETWEEN '".$datainicio."' AND '".$datatermino."' AND  COD_USUARIO_RESERVA='$usuario' AND ID_ANDAR_RESERVA=$andar AND ID_SALA_RESERVA=$sala ORDER BY DATA_RESERVA,CASE WHEN HORARIO_ID_HORARIO LIKE 'M%' THEN 1 WHEN HORARIO_ID_HORARIO LIKE 'T%' THEN 2 ELSE 3 END;");
			while($row=$result->fetch_assoc()){
				echo "<tr>";
				echo "<td>".$row['DATA_RESERVA']."</td>
               		  <td>".$row['ID_BLOCO_RESERVA'].$row['ID_ANDAR_RESERVA'].$row['ID_SALA_RESERVA']."</td>
               		  <td>".$row['HORARIO_ID_HORARIO']."</td>";
               	echo "</tr>";
			}
		}

		
	}

?>