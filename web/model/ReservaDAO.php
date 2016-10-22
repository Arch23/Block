<?php
	date_default_timezone_set ("America/Sao_Paulo");
	class  ReservaDAO{ //Classe para controle das reservas
		public $conn; //Conexão do usuário

	 	function __construct($username,$password){ //Passa username e senha do usuário quando a classe for instanciada
			$servername="localhost";
			$dbname="roomz";
			$this->conn = new mysqli($servername, $username, $password,$dbname); //Cria a conexão do usuário dentro da classe

		}
		function verificaHorario(){
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
			return $codhorario;
		}

		function retornaBlocos(){  //Insere os blocos no list na view
				$sql="SELECT NOME_BLOCO FROM BLOCO";
				$result=$this->conn->query($sql);
				while($row = $result->fetch_assoc()) {
       				 echo '<option value="'.$row["NOME_BLOCO"].'" class="dropdown-contet">'.$row["NOME_BLOCO"].'</option>';
    			}
		}

		function retornaSalas($Bloco){ //Insere as salas no list da view
			$sql="SELECT ID_SALA,ID_ANDAR FROM SALA, BLOCO WHERE SALA.ID_BLOCO=BLOCO.ID_BLOCO AND '".$Bloco."'=BLOCO.NOME_BLOCO";
			$result=$this->conn->query($sql);
				while($row = $result->fetch_assoc()) {
     				 echo '<option value="'.$row["ID_ANDAR"].$row["ID_SALA"].'" class="dropdown-contet">'.$row["ID_ANDAR"].$row["ID_SALA"].'</option>';
    			}
		}

		function retornaReservaNormal($Bloco,$Andar,$Sala,$Datadia,$coduser){	//Retorna as reservas criando a tabela na view
			$codhorario= $this->verificaHorario();
			$coduser=substr($coduser, 1); //Retira o a do nome de usuário
			$dia=substr($Datadia, 0,2); //Pega o dia
			$mes=substr($Datadia,3,2); //Pega o mes
			$ano=substr($Datadia,6,4); //Pega o ano
			$Data=($ano.'-'.$mes.'-'.$dia); //Transforma para o padrão do mysql
			$timestamp=strtotime($Data); //pega o timestamp
			$diasem=Date("D",$timestamp); //Pega o dia da semana
			$datefix=0; //Dia fixo para referenciar a tabela
			$letra='a'; //Letra do horário, M, T,N....
			echo "<thead>"; //Cria o cabeçalho da tabela...
				echo'<tr>
           			<th style="color:white;" class="tg-yw4l">Cod</th>
           			<th style="color:white;" class="tg-yw4l">Segunda</th>
           			<th style="color:white;" class="tg-yw4l">Terça</th>
           			<th style="color:white;"class="tg-yw4l">Quarta</th>
        	     	<th style="color:white;"class="tg-yw4l">Quinta</th>
            		<th style="color:white;"class="tg-yw4l">Sexta</th>
            		<th style="color:white;"class="tg-yw4l">Sábado</th>
         </tr>';
         echo "</thead>";
         echo "<tbody>";
            if($diasem=="Mon"){ //Ifs e elses realizam o calculo da data fixa para inserção na tabela
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

				for($i=0 ;$i<3 ;$i++){ //Percorre por M,T,N....
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
					for($j=1; $j<7; $j++){ // De M1 até M6, T1 até T6....
						echo '<td>'.$letra.$j.'</td>';
							for($k=0 ;$k<6; $k++){ //Percore os dias da semana
								$date = strtotime("+"."$k"."days", strtotime($datefix)); //Calcula o dia da semana
								$date= date("Y-m-d", $date); //Transforma o padrão para mysql
								//Verifica a tabela de reserva normal
								$sql="SELECT HORARIO_ID_HORARIO FROM RESERVA_NORMAL, BLOCO WHERE SALA_ID_BLOCO=BLOCO.ID_BLOCO AND '".$Bloco."'=BLOCO.NOME_BLOCO AND DATA_RESERVA='$date' AND SALA_ID_SALA=$Sala AND SALA_ID_ANDAR=$Andar AND HORARIO_ID_HORARIO='".$letra.$j."'";

								//Verifica outra trabela de reservas
								$sqlf="SELECT HORARIO_ID_HORARIO FROM RESERVA, BLOCO WHERE ID_BLOCO_RESERVA=BLOCO.ID_BLOCO AND '".$Bloco."'=BLOCO.NOME_BLOCO AND DATA_RESERVA='$date' AND ID_SALA_RESERVA=$Sala AND ID_ANDAR_RESERVA=$Andar AND HORARIO_ID_HORARIO='".$letra.$j."'";
									//Executa as querys
									$Result=$this->conn->query($sql);
									$Resultf=$this->conn->query($sqlf);
								    //Se nenhum dos campos tiver reserva considera que a sala está disponível
									if(($Result->num_rows==0) && ($Resultf->num_rows==0)){
										if($date>=date("Y-m-d")){
												if($date==date("Y-m-d")){
													if($codhorario!="N6"){
													if(substr($codhorario,0,1)=='M'){
															if($letra=='M'){
																if($j>=substr($codhorario,1,1)){
																	echo '<td style="color:blue;">'.$letra.$j." ".$date.'</td>';
																}else{
																	echo '<td style="color:gray;">INDISPONÍVEL</td>';
																}
															}
															else{
																echo '<td style="color:blue;">'.$letra.$j." ".$date.'</td>';
															}
														}
														else if(substr($codhorario,0,1)=='T'){
															if($letra=='N'){
																echo '<td style="color:blue;">'.$letra.$j." ".$date.'</td>';
															}
															else if(($letra=='T') AND ($j>=substr($codhorario,1,1))){
																echo '<td style="color:blue;">'.$letra.$j." ".$date.'</td>';
															}
															else{
																echo '<td style="color:gray;">INDISPONÍVEL</td>';
															}
														}
														else if($letra=='N' AND substr($codhorario,0,1)=='N'){
															if($j>=substr($codhorario,1,1)){
																echo '<td style="color:blue;">'.$letra.$j." ".$date.'</td>';
															}
															else{
																echo '<td style="color:gray;">INDISPONÍVEL</td>';
															}
														}
														else{
															echo '<td style="color:gray;">INDISPONÍVEL</td>';
														}
													}else{
														echo '<td style="color:blue;">'.$letra.$j." ".$date.'</td>';
													}
												}else{
													echo '<td style="color:blue;">'.$letra.$j." ".$date.'</td>';
												}
										}else{
											echo '<td style="color:gray;">INDISPONÍVEL</td>';
										}
									}else{ //Verifica se a reserva é daquele usuário ou se é de outro
										 $sqlu= "SELECT HORARIO_ID_HORARIO FROM RESERVA, BLOCO WHERE ID_BLOCO_RESERVA=BLOCO.ID_BLOCO AND '".$Bloco."'=BLOCO.NOME_BLOCO AND DATA_RESERVA='$date' AND ID_SALA_RESERVA=$Sala AND ID_ANDAR_RESERVA=$Andar AND HORARIO_ID_HORARIO='".$letra.$j."' AND COD_USUARIO_RESERVA=".$coduser;
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

	function realizaReserva($Bloco,$Andar,$Sala,$vet,$recorrencia){//Função para realizar reservas
		$coduser=$_SESSION["usuario"]; //Puxa o usuário ppela sessão
		$coduser=substr($coduser, 1); //Retira o a do codigo
		$wd=0; //vigia
		$wd2=0;
		$sql="SELECT TIPO_USUARIO,SIGLA_DEPARTAMENTO FROM a".$coduser."view"; //Puxa a visão do usuário
		$Result=$this->conn->query($sql);
		while($row=$Result->fetch_assoc()){ //Verifica o tipo de usuario
 			$departamento=$row["SIGLA_DEPARTAMENTO"]; //Aproveito para pegar o departamento
			if($row["TIPO_USUARIO"]=="ALUNO"){ //Se for aluno não tem permissão
				echo "<p>Você não tem permissão para reservar salas!</p>";
				exit(); //Encerra o código
			}
		}
		$sql="SELECT SIGLA_DEPARTAMENTO FROM SALA,BLOCO WHERE ID_SALA=".$Sala." AND ID_ANDAR=".$Andar." AND NOME_BLOCO='".$Bloco."'
		AND SALA.ID_BLOCO=BLOCO.ID_BLOCO"; //Verifica o departamento da sala
		$Result=$this->conn->query($sql);
		while($row=$Result->fetch_assoc()){
			if($row["SIGLA_DEPARTAMENTO"]!=$departamento && $row["SIGLA_DEPARTAMENTO"]!="NN"){ //Se o usuário não for daquele departamento informa o departamento e passa o contato
				echo "<p>Você não tem permissão para reservar esta sala!\nContate o ".$row["SIGLA_DEPARTAMENTO"]."!</p>";
				exit();
			}

		}

		if(count($vet)>0){ //Verifica se o vetor veio vazio
			$Result=$this->conn->query("SELECT ID_BLOCO FROM BLOCO WHERE NOME_BLOCO='$Bloco'"); //Pega a ID do bloco
			while($row=$Result->fetch_assoc()){
				$Bloco=$row["ID_BLOCO"];
			}

		foreach ($vet as $key=>$value) {
			for($a=0;$a<$recorrencia;$a++){
				 if($value=="INDISPONÍVEL"){ //Verifica se selecionou uma indisponível
				 	$wd++;
			 	}
			 	else{
			 		 $hor=substr($value, 0,2); //Puxa o ID do horário M1, M2, T5 etc...
			    	 $data=substr($value,2,11); //Puxa a data
			    	 $dateaux = strtotime("+".($a*7)."days", strtotime($data));
				     $data= date("Y-m-d", $dateaux);
				     $dateaux = strtotime("+ 2 days", strtotime($data));
			    	 $sql="INSERT INTO RESERVA VALUES('$data',$Sala,$Andar,$Bloco,$coduser,'$hor')"; //Insere na tabela de reservas
				    if($dateaux>=time()){
				     	 if($this->conn->query($sql)){
				     	 	if($wd2==0){
				     	 		echo "<p>Os seguintes horários/datas foram reservados para você:</p>"; //Cabeçalho da mensagem
				     	 	}
				     	 	$wd2++;
				     	 echo"<p>".($hor." ".$data)."</p>"; //Informa as datas e horários reservados
				     	}
				  	   }
				 	}
			 	}
		}
		if($wd>0){ //Se o vigia detectar que foi selecionado um indisponível informa para o usuário
	 		echo "<p>Atenção, você selecionou um ou mais horários indisponíveis!</p>";
	 	}
	 }
	 else{ //Se o usuário não selecionar nenhum informa ao usuário.
	 	echo "<p>Selecione ao menos um horário</p>";
	 }

	}
	function cancelaReserva($bloco,$andar,$sala,$data,$horario){
		$coduser=$_SESSION["usuario"]; //Puxa o usuário ppela sessão
		$coduser=substr($coduser, 1); //Retira o a do codigo
		$sql="DELETE FROM RESERVA WHERE COD_USUARIO_RESERVA=$coduser AND ID_BLOCO_RESERVA= $bloco AND ID_ANDAR_RESERVA= $andar AND  ID_SALA_RESERVA=  $sala AND DATA_RESERVA='$data' AND HORARIO_ID_HORARIO='$horario'";
		if($this->conn->query($sql)){
			echo "Reserva Cancelada!";
		}else{
			echo "Erro ao cancelar, tente novamente!";
		}
	}
}
?>
