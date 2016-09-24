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

	$bloco=$_POST["Bloco"];
	$datadia=$_POST["Datadia"];
	$sala=$_POST["Sala"];
	$andar=substr($sala,0,1);
	$salaid=substr($sala,1,1);	
	$obj=new ReservaDAO();

   if($_POST["Tag"]==1){

        $obj->retornaSalas($_POST["Bloco"]);
	}

	if($_POST["Tag"]==2){
        $obj->retornaReservaNormal($bloco,$andar,$salaid,$datadia);
	}
?>