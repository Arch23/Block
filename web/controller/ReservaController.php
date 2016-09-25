<?php
include("../model/UserDAO.php");
include("../model/ReservaDAO.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */   
   session_start();
   $obj=new UserDAO("localhost",$_SESSION["usuario"],$_SESSION["senha"],"roomz");
	
	
	$obj=new ReservaDAO();

   if($_POST["Tag"]==1){
   		$bloco=$_POST["Bloco"];
        $obj->retornaSalas($_POST["Bloco"]);
	}

	else if($_POST["Tag"]==2){
			$usuario=$_SESSION["usuario"];
			$bloco=$_POST["Bloco"];
			$datadia=$_POST["Datadia"];
			$sala=$_POST["Sala"];
			$andar=substr($sala,0,1);
			$salaid=substr($sala,1,1);
        	$obj->retornaReservaNormal($bloco,$andar,$salaid,$datadia,$usuario);
	}

		else if($_POST["Tag"]==3){
			$bloco=$_POST["Bloco"];
			$sala=$_POST["Sala"];
			$andar=substr($sala,0,1);
			$salaid=substr($sala,1,1);
			$dadosreserv=json_decode($_POST["dadosreserv"]);
			$obj->realizaReserva($bloco,$andar,$salaid,$dadosreserv);
			}
?>