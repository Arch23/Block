	<?php
		include("../model/UserDAO.php");
                session_start();
		$obj= new UserDAO("localhost","a".$_POST['Codigo'],$_POST['Senha'],"roomz");
		if(!$obj->conn->connect_error){
            $_SESSION["usuario"]="a".$_POST['Codigo'];
            $_SESSION["senha"]=$_POST['Senha'];
            echo"foi";
            exit();
		}else{
			 echo"nao foi";
			 exit();
		}
		 
	?>