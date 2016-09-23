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
   //header("Location:../view/Reservar.html");


   if($_POST["Tag"]==1){
   	  	include("../model/ReservaDAO.php");
        $obj=new ReservaDAO();
        $obj->retornaSalas($_)
	}
?>