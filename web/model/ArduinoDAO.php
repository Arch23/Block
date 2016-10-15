<?php
	date_default_timezone_set ("America/Sao_Paulo");

	function verificaGrupoHor($codhorario,$usuario,$conn,$bloco,$andar,$sala){		
		$cont=0;
		$vet=array();
		if(substr($codhorario,0,1)=='M'){
			$sql="SELECT HORARIO_ID_HORARIO FROM RESERVA WHERE HORARIO_ID_HORARIO LIKE 'M%' AND DATA_RESERVA='".date("Y-m-d")."'
			 AND COD_USUARIO_RESERVA='$usuario' AND ID_SALA_RESERVA=".$sala." AND ID_ANDAR_RESERVA=".$andar."
		     AND ID_BLOCO_RESERVA=".$bloco." AND HORARIO_ID_HORARIO >='$codhorario'";
			$result=$conn->query($sql);
			while($row=$result->fetch_assoc()){
				array_push($vet,substr($row["HORARIO_ID_HORARIO"],1));
			}
		}
		else if(substr($codhorario,0,1)=='T'){	
			$sql="SELECT HORARIO_ID_HORARIO FROM RESERVA WHERE HORARIO_ID_HORARIO LIKE 'T%' AND DATA_RESERVA='".date("Y-m-d")."'
				 AND COD_USUARIO_RESERVA='$usuario' AND ID_SALA_RESERVA=".$sala." AND ID_ANDAR_RESERVA=".$andar."
		         AND ID_BLOCO_RESERVA=".$bloco." AND HORARIO_ID_HORARIO >='$codhorario'";
			$result=$conn->query($sql);
			while($row=$result->fetch_assoc()){
				array_push($vet,substr($row["HORARIO_ID_HORARIO"],1));	
			}
		}
		else if(substr($codhorario,0,1)=='N'){
			$sql="SELECT HORARIO_ID_HORARIO FROM RESERVA WHERE HORARIO_ID_HORARIO LIKE 'N%' AND DATA_RESERVA='".date("Y-m-d")."'
				 AND COD_USUARIO_RESERVA='$usuario' AND ID_SALA_RESERVA=".$sala." AND ID_ANDAR_RESERVA=".$andar."
		         AND ID_BLOCO_RESERVA=".$bloco." AND HORARIO_ID_HORARIO >='$codhorario'";
			$result=$conn->query($sql);
			while($row=$result->fetch_assoc()){
				array_push($vet,substr($row["HORARIO_ID_HORARIO"],1));
			}			
		}
		 for($i=0;$i<count($vet)-1;$i++){
		 		if($vet[$i+1]-$vet[$i]>1){
		 			return substr($codhorario,0,1).$vet[$i];
		 	} 		 	
		 }
		 return substr($codhorario,0,1).$vet[count($vet)-1];

	}

	$conn = new mysqli("localhost", "arduino", "","roomz");
	$data=date("Y-m-d");
	echo $data."\n";
	
	$h0730= new DateTime('07:30:00');
	$h0820= new DateTime('08:20:00');
	$h0910= new DateTime('09:10:00');
	$h1000= new DateTime('10:00:00');
	$h1020= new DateTime('10:20:00');
	$h1110= new DateTime('11:10:00');
	$h1200= new DateTime('12:00:00');

	$h1250= new DateTime('12:50:00');
	$h1300= new DateTime('13:00:00');
	$h1350= new DateTime('13:50:00');
	$h1440= new DateTime('14:40:00');
	$h1530= new DateTime('15:30:00');
	$h1550= new DateTime('15:50:00');
	$h1640= new DateTime('16:40:00');
	$h1730= new DateTime('17:30:00');
	$h1750= new DateTime('17:50:00');

	$h1840= new DateTime('18:40:00');
	$h1930= new DateTime('19:30:00');
	$h2020= new DateTime('20:20:00');
	$h2110= new DateTime('21:10:00');
	$h2120= new DateTime('21:20:00');
	$h2210= new DateTime('22:10:00');
	$h2300= new DateTime('23:00:00');

	$now= new DateTime('now');
	$codhorario="teste";
	if ($h0730 <= $now && $now <= $h0820 ) {
	    $codhorario="M1";
	}
	else if($h0820 <= $now && $now <=$h0910){
		$codhorario="M2";
	}
	else if($h0910 <= $now && $now <=$h1020){
		$codhorario="M3";
	}
	else if($h1020 <= $now && $now <=$h1110){
		$codhorario="M4";
	}
	else if($h1110 <= $now && $now <=$h1200){
		$codhorario="M5";
	}

	else if($h1200 <= $now && $now <=$h1300){
		$codhorario="M6";
	}	
	else if($h1300 <= $now && $now <=$h1350){
		$codhorario="T1";
	}
	else if($h1350 <= $now && $now <=$h1440){
		$codhorario="T2";
	}
	else if($h1440 <= $now && $now <=$h1550){
		$codhorario="T3";
	}
	else if($h1550 <= $now && $now <=$h1640){
		$codhorario="T4";
	}
	else if($h1640 <= $now && $now <=$h1730){
		$codhorario="T5";
	}
	else if($h1730 <= $now && $now <=$h1840){
		$codhorario="T6";
	}
	else if($h1840 <= $now && $now <=$h1930){
		$codhorario="N1";
	}
	else if($h1930 <= $now && $now <=$h2020){
		$codhorario="N2";
	}
	else if($h2020 <= $now && $now <=$h2120){
		$codhorario="N3";
	}
	else if($h2120 <= $now && $now <=$h2210){
		$codhorario="N4";
	}
	else if($h2210 <= $now && $now <=$h2300){
		$codhorario="N5";
	}else{
		$codhorario="N6";
	}
	echo "\n".$now->format('H:i:s');
	echo "\n".$codhorario;

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
		$sql="SELECT * FROM RESERVA WHERE ID_SALA_RESERVA=".$sala." AND ID_ANDAR_RESERVA=".$andar." AND ID_BLOCO_RESERVA=".$bloco." AND COD_USUARIO_RESERVA=".$codusuario." AND HORARIO_ID_HORARIO='$codhorario' AND DATA_RESERVA='$data'";
			$Result=$conn->query($sql);
			if($Result->num_rows>0){
				echo"<Pode entrar".verificaGrupoHor($codhorario,$codusuario,$conn,$bloco,$andar,$sala).">";
			}else{
				$sql="SELECT HORARIO_ID_HORARIO FROM RESERVA_NORMAL WHERE DATA_RESERVA='$data' AND SALA_ID_SALA=$sala AND SALA_ID_ANDAR=$andar AND SALA_ID_BLOCO=$bloco AND HORARIO_ID_HORARIO='$codhorario'";
				$sql2="SELECT * FROM RESERVA WHERE ID_SALA_RESERVA=".$sala." AND ID_ANDAR_RESERVA=".$andar." AND ID_BLOCO_RESERVA=".$bloco." AND HORARIO_ID_HORARIO='$codhorario' AND DATA_RESERVA='$data'";
				$Result=$conn->query($sql);
				$Result2=$conn->query($sql2);
				if($Result->num_rows==0 && $Result2->num_rows==0){
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
						 $sql="INSERT INTO RESERVA VALUES('$data',$sala,$andar,$bloco,$codusuario,'$codhorario')";
						 $Result=$conn->query($sql);
						 echo "<Reserva liberada!".verificaGrupoHor($codhorario,$codusuario,$conn,$bloco,$andar,$sala).">";
					}else{
						echo "<Voce nao pode usar esta sala!>";
					}
			}else{
				echo "<Sala utilizada!>";			}	
		}
		exit;
?>