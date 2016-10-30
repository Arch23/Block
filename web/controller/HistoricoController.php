<?php
	session_start();
	include("../model/HistoricoDAO.php");
	$obj=new HistoricoDAO($_SESSION["usuario"],$_SESSION["senha"]);
	
	if($_POST["Tag"]==1){
		$obj->retornaHistorico($_POST["DataInicio"],$_POST["DataTermino"],$_POST["Bloco"]);
	}
	else if($_POST["Tag"]==2){
		$obj->retornaHistoricoSalas($_POST["DataInicio"],$_POST["DataTermino"],$_POST["Bloco"],$_POST["Sala"]);
	}
	else if($_POST["Tag"]==3){
		$obj->retornaHistoricoCompleto($_POST["DataInicio"],$_POST["DataTermino"]);
	}
?>