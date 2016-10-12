<?php
	include("../model/UserDAO.php");
	include("../model/ReservaDAO.php");
	session_start();
	$objuser=new UserDAO("localhost",$_SESSION["usuario"],$_SESSION["senha"],"roomz");
	$objreserva=new ReservaDAO($_SESSION["usuario"],$_SESSION["senha"]);
	if($_POST["Tag"]==1){
		echo $objuser->retornaNomeUser();
		exit;
	}
	else if($_POST["Tag"]==2){
		$bas=$_POST["Sala"];
		$horario=$_POST["Horario"];
		$data=$_POST["Data"];
		$bloco=substr($bas, 15,1);
		$andar=substr($bas,16,1);
		$sala=substr($bas,17,1);
		$data=substr($data, 5);
		$horario=substr($horario, 9);
		$objreserva->cancelaReserva($bloco,$andar,$sala,$data,$horario);
		exit;
	}
?>