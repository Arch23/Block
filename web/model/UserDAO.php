<?php
    date_default_timezone_set ("America/Sao_Paulo");
	class UserDAO{ //Classe para a conexão e criação(cadastro de um usuário)
                public $conn; //Conexão do usuário
                public $username;

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
            $codhorario=$this->verificaHorario();
            $coduser=substr($this->username, 1); //Retira o a do nome de usuário
            $result=$this->conn->query("SELECT * FROM RESERVA WHERE COD_USUARIO_RESERVA=$coduser AND DATA_RESERVA>='".date("Y-m-d")."'
                 ORDER BY DATA_RESERVA,CASE WHEN HORARIO_ID_HORARIO LIKE 'M%' THEN 1 WHEN HORARIO_ID_HORARIO LIKE 'T%' THEN 2 ELSE 3 END;");
            while($row=$result->fetch_assoc()){
            $cont++;
            if($row["DATA_RESERVA"]!=date("Y-m-d")){        
                $this->enviaDiv($cont,$row["ID_BLOCO_RESERVA"],$row["ID_ANDAR_RESERVA"],$row["ID_SALA_RESERVA"],$row["DATA_RESERVA"],$row["HORARIO_ID_HORARIO"]);
              }else{
                    if($codhorario!='N6'){
                        if(substr($codhorario,0,1)=='M'){
                            if(substr($row["HORARIO_ID_HORARIO"], 0,1)=='M'){
                                if(substr($row["HORARIO_ID_HORARIO"], 1,1)>=substr($codhorario,1,1)){
                                  $this->enviaDiv($cont,$row["ID_BLOCO_RESERVA"],$row["ID_ANDAR_RESERVA"],$row["ID_SALA_RESERVA"],$row["DATA_RESERVA"],$row["HORARIO_ID_HORARIO"]);
                                }
                            }else{
                                $this->enviaDiv($cont,$row["ID_BLOCO_RESERVA"],$row["ID_ANDAR_RESERVA"],$row["ID_SALA_RESERVA"],$row["DATA_RESERVA"],$row["HORARIO_ID_HORARIO"]);
                            }
                        }
                        else if(substr($codhorario, 0,1)=='T'){
                            if(substr($row["HORARIO_ID_HORARIO"], 0,1)=='M'){

                            }
                            else if(substr($row["HORARIO_ID_HORARIO"], 0,1)=='T'){
                                if(substr($row["HORARIO_ID_HORARIO"], 1,1)>=substr($codhorario,1,1)){
                                  $this->enviaDiv($cont,$row["ID_BLOCO_RESERVA"],$row["ID_ANDAR_RESERVA"],$row["ID_SALA_RESERVA"],$row["DATA_RESERVA"],$row["HORARIO_ID_HORARIO"]);
                                }
                                }else{
                                $this->enviaDiv($cont,$row["ID_BLOCO_RESERVA"],$row["ID_ANDAR_RESERVA"],$row["ID_SALA_RESERVA"],$row["DATA_RESERVA"],$row["HORARIO_ID_HORARIO"]);
                                }                      
                            }                    
                            else if(substr($codhorario,0,1)=='N'){
                                if(substr($codhorario,0,1)!=substr($row["HORARIO_ID_HORARIO"], 0,1)){

                                }
                                else if(substr($row["HORARIO_ID_HORARIO"], 1,1)>=substr($codhorario,1,1)){
                                     $this->enviaDiv($cont,$row["ID_BLOCO_RESERVA"],$row["ID_ANDAR_RESERVA"],$row["ID_SALA_RESERVA"],$row["DATA_RESERVA"],$row["HORARIO_ID_HORARIO"]);
                                }
                            }                            
                        }else{
                            $hantes=new DateTime('23:00:00');
                            $hdepois= new DateTime('23:59:59');
                            $now2 = new DateTime('now');
                            if($now2>=$hantes AND $now2<=$hdepois){
                            }else{
                                $this->enviaDiv($cont,$row["ID_BLOCO_RESERVA"],$row["ID_ANDAR_RESERVA"],$row["ID_SALA_RESERVA"],$row["DATA_RESERVA"],$row["HORARIO_ID_HORARIO"]);
                            }
                    }
               }
            }
        }

        function enviaDiv($cont,$bloco,$sala,$andar,$data,$horario){
            echo' <div id="Reserva'.$cont.'"class="panel panel-default">
                        <div class="panel-heading">
                            <h3 id="Reserva'.$cont.'sala" class="panel-title">Sala reservada:'.$bloco.$andar.$sala.'</h3>
                      </div>
                      <div  class="panel-body">
                        <p id="Reserva'.$cont.'data" class="data-reserva">Data:'.$data.'</p>
                        <p id="Reserva'.$cont.'horario" class="hora-reserva">Horário:'.$horario.'</p>
                        <button id="Reserva'.$cont.'" class="round-button"> X</button>
                    </div>
            </div>';
        }
	}				
	?>