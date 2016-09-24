<?php
include("../model/ReservaDAO.php");
	
	$bloco=$_POST["Bloco"];
	$datadia=$_POST["Datadia"];
	$sala=$_POST["Sala"];

	$andar=substr($sala,0,1);
	$salaid=substr($sala,1,1);

	$obj= new ReservaDAO();
	$obj->retornaReservaNormal($bloco,$andar,$salaid,$datadia);

?>