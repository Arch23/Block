<?php
	session_start();		
	$_SESSION["usuario"]="";
    $_SESSION["senha"]="";
    session_destroy();   
    header("Location:../index.html");
    ?>
