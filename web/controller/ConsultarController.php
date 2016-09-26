<?php
include("../model/ReservaDAO.php");
	session_start();

	$bloco=$_POST["Bloco"];
	$datadia=$_POST["Datadia"];
	$sala=$_POST["Sala"];

	$andar=substr($sala,0,1);
	$salaid=substr($sala,1,1);
	$usuario=$_SESSION["usuario"];

	$obj= new ReservaDAO($_SESSION["usuario"],$_SESSION["senha"]);
	$obj->retornaReservaNormal($bloco,$andar,$salaid,$datadia,$usuario);

?>