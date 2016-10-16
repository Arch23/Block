<?php
include("../model/ReservaDAO.php");

   session_start(); //Inicia a sessão
	
	
	$obj=new ReservaDAO($_SESSION["usuario"],$_SESSION["senha"]); //Inicializa a classe de reserva com o user e senha

   if($_POST["Tag"]==1){ //Switch para indicar o que o controller irá fazer atraves da tag do js
   		$bloco=$_POST["Bloco"];
        $obj->retornaSalas($_POST["Bloco"]);
	}

	else if($_POST["Tag"]==2){  //Consulta 
			$usuario=$_SESSION["usuario"];
			$bloco=$_POST["Bloco"];
			$datadia=$_POST["Datadia"];
			$sala=$_POST["Sala"];
			$andar=substr($sala,0,1);
			$salaid=substr($sala,1,1);
        	$obj->retornaReservaNormal($bloco,$andar,$salaid,$datadia,$usuario);
	}

		else if($_POST["Tag"]==3){ //Realização de reserva
			$recorrencia=$_POST["Recorrencia"];
			$bloco=$_POST["Bloco"];
			$sala=$_POST["Sala"];
			$andar=substr($sala,0,1);//Faz o split de andar e sala
			$salaid=substr($sala,1,1);
			$dadosreserv=json_decode($_POST["dadosreserv"]); //Converte a string em um vetor novamente
			$obj->realizaReserva($bloco,$andar,$salaid,$dadosreserv,$recorrencia); //Chama o metodo de realização de reserva
			}
?>