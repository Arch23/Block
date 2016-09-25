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

		function retornaReservaNormal($Bloco,$Andar,$Sala,$Datadia,$coduser){			
			$coduser=substr($coduser, 1);
			$dia=substr($Datadia, 0,2);
			$mes=substr($Datadia,3,2);
			$ano=substr($Datadia,6,4);
			$Data=($ano.'-'.$mes.'-'.$dia);
			$timestamp=strtotime($Data);
			$diasem=Date("D",$timestamp);
			$datefix=0;
			$letra='a';
			echo "<thead>";
				echo'<tr>
           			<th class="tg-baqh"></th>
           			<th class="tg-yw4l">Segunda</th>
           			<th class="tg-yw4l">Terça</th>
           			<th class="tg-yw4l">Quarta</th>
        	     	<th class="tg-yw4l">Quinta</th>
            		<th class="tg-yw4l">Sexta</th>
            		<th class="tg-yw4l">Sábado</th>
         </tr>';
         echo "</thead>";
         echo "<tbody>";
            if($diasem=="Mon"){
            	$datefix = strtotime("+0 days", strtotime($Data));
				$datefix= date("Y-m-d", $datefix);
            }
            else if($diasem=="Tue"){
            	$datefix = strtotime("-1 days", strtotime($Data));
				$datefix= date("Y-m-d", $datefix);
            }

            else if($diasem=="Wed"){
            	$datefix = strtotime("-2 days", strtotime($Data));
				$datefix= date("Y-m-d", $datefix);
            }
            else if($diasem=="Thu"){
            	$datefix = strtotime("-3 days", strtotime($Data));
				$datefix= date("Y-m-d", $datefix);
            }
			else if($diasem=="Fri"){
				$datefix = strtotime("-4 days", strtotime($Data));
				$datefix= date("Y-m-d", $datefix);
			}
			else if($diasem=="Sat"){
				$datefix = strtotime("-5 days", strtotime($Data));
				$datefix= date("Y-m-d", $datefix);
			}
			else if($diasem=="Sun"){
				$datefix = strtotime("+1 days", strtotime($Data));
				$datefix= date("Y-m-d", $datefix);
			}

				for($i=0 ;$i<3 ;$i++){
					if($i==0){
						$letra='M';
					}
					else if($i==1){
						$letra='T';
					}
					else if($i==2){
						$letra='N';
					}
					echo"<tr>";					
					for($j=1; $j<7; $j++){
						echo '<td>'.$letra.$j.'</td>';				
							for($k=0 ;$k<6; $k++){
								$date = strtotime("+"."$k"."days", strtotime($datefix));
								$date= date("Y-m-d", $date);		

								$sql="SELECT HORARIO_ID_HORARIO FROM RESERVA_NORMAL, BLOCO WHERE SALA_ID_BLOCO=BLOCO.ID_BLOCO AND '".$Bloco."'=BLOCO.NOME_BLOCO AND DATA_RESERVA='$date' AND SALA_ID_SALA=$Sala AND SALA_ID_ANDAR=$Andar AND HORARIO_ID_HORARIO='".$letra.$j."'";


								$sqlf="SELECT HORARIO_ID_HORARIO FROM RESERVA, BLOCO WHERE SALA_ID_BLOCO=BLOCO.ID_BLOCO AND '".$Bloco."'=BLOCO.NOME_BLOCO AND DATA_RESERVA='$date' AND ID_SALA=$Sala AND ID_ANDAR=$Andar AND HORARIO_ID_HORARIO='".$letra.$j."'";

									$Result=$this->conn->query($sql);
									$Resultf=$this->conn->query($sqlf);

									if(($Result->num_rows==0) && ($Resultf->num_rows==0)){								
									echo '<td style="color:blue;" id="batata">'.$letra.$j." ".$date.'</td>';
									}else{
										 $sqlu= "SELECT HORARIO_ID_HORARIO FROM RESERVA, BLOCO WHERE SALA_ID_BLOCO=BLOCO.ID_BLOCO AND '".$Bloco."'=BLOCO.NOME_BLOCO AND DATA_RESERVA='$date' AND ID_SALA=$Sala AND ID_ANDAR=$Andar AND HORARIO_ID_HORARIO='".$letra.$j."' AND COD_USUARIO=".$coduser;
									     $Resultu=$this->conn->query($sqlu);
										 if($Resultu->num_rows!=0){
										 	echo '<td style="color:green;" class="tg-yw4l">Reservado para Você</td>';
										  }else{
											echo '<td style="color:red;" class="tg-yw4l">INDISPONÍVEL</td>';
										 }	
						
									}																			
						
					}
					echo"</tr>";	
					
				}

					
			}
			echo "</tbody>";
	
	}

	function realizaReserva($Bloco,$Andar,$Sala,$vet){
		$coduser=$_SESSION["usuario"];
		$coduser=substr($coduser, 1);
		$wd=0;
		if(count($vet)>0){
			$Result=$this->conn->query("SELECT ID_BLOCO FROM BLOCO WHERE NOME_BLOCO='$Bloco'");
			while($row=$Result->fetch_assoc()){
				$Bloco=$row["ID_BLOCO"];
			}
		echo "Os seguintes horários/datas foram reservados para você:\n";	
		foreach ($vet as $key=>$value) {
				 if($value=="INDISPONÍVEL"){
				 	$wd++;
			 	}		 	
			 	else{
			 		 $hor=substr($value, 0,2);
			    	 $data=substr($value,2,11);
			    	 $sql="INSERT INTO RESERVA VALUES('$data',$Sala,$Andar,$Bloco,$coduser,'$hor')";
			     	 $this->conn->query($sql);
			     	 echo($hor.$data."\n");

			 	}
		}
		if($wd>0){
	 		echo "Atenção, você selecionou um ou mais horários já reservados!\n";
	 	}
	 }
	 else{
	 	echo "Selecione ao menos um horário";
	 }
				 	
	}
}
?>