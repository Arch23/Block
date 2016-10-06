<?php
	$conn = new mysqli("localhost", "arduino", "","roomz");
	//echo "<estou aqui>";
	if(isset($_GET["key"])&&isset($_GET["bloco"])&&isset($_GET["andar"])&&isset($_GET["sala"])){
		$key=$_GET["key"];
		$bloco=$_GET["bloco"];
		$andar=$_GET["andar"];
		$sala=$_GET["sala"];
	}else{
		$tag=0;
		echo"<Erro>";
		exit;
	}
		$sql="SELECT COD_USUARIO,TIPO_USUARIO FROM USUARIO WHERE KEY_USER='".$key."'";
		$Result=$conn->query($sql);
		if($Result->num_rows==0){
			echo "<Usuario nao encontrado!>";
			exit;
		}
		while($row=$Result->fetch_assoc()){
			$codusuario=$row["COD_USUARIO"];
			if($row["TIPO_USUARIO"]=="ALUNO"){
				echo"<Voce nao pode reservar salas>";
				exit;
			}
		}
		$sql="SELECT * FROM RESERVA WHERE ID_SALA_RESERVA=".$sala." AND ID_ANDAR_RESERVA=".$andar." AND ID_BLOCO_RESERVA=".$bloco." AND COD_USUARIO_RESERVA=".$codusuario." AND HORARIO_ID_HORARIO='M1' AND DATA_RESERVA='2016-10-07'";
			$Result=$conn->query($sql);
			if($Result->num_rows>0){
				echo"<Pode entrar>";
			}else{
				$sql="SELECT HORARIO_ID_HORARIO FROM RESERVA_NORMAL WHERE DATA_RESERVA='2016-10-07' AND SALA_ID_SALA=$sala AND SALA_ID_ANDAR=$andar AND SALA_ID_BLOCO=$bloco AND HORARIO_ID_HORARIO='M1'";
				$Result=$conn->query($sql);
				if($Result->num_rows==0){
					$sql="SELECT SIGLA_DEPARTAMENTO FROM USUARIO WHERE KEY_USER='".$key."'";
					$Result=$conn->query($sql);
					while($row=$Result->fetch_assoc()){
						$dept=$row["SIGLA_DEPARTAMENTO"];
					}				
					$sql="SELECT SIGLA_DEPARTAMENTO FROM SALA WHERE ID_SALA=".$sala." AND ID_ANDAR=".$andar." AND ID_BLOCO=".$bloco;
					$Result=$conn->query($sql);
					while($row=$Result->fetch_assoc()){
						$dept2=$row["SIGLA_DEPARTAMENTO"];
					}
					if($dept==$dept2){
						 $sql="INSERT INTO RESERVA VALUES('2016-10-07',$sala,$andar,$bloco,$codusuario,'N5')";
						 $Result=$conn->query($sql);
						 echo "<Reserva liberada!>";
					}else{
						echo "<Voce nao pode usar esta sala!>";
					}
			}else{
				echo "sala utilizada!";			}	
		}
		exit;
?>