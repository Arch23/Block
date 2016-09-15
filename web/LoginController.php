	<?php
		include("UserDAO.php");
                session_start();
		$obj= new UserDAO("localhost","a".$_POST['Codigo'],$_POST['Senha'],"roomz");
		if(!$obj->conn->connect_error){
                        $_SESSION["usuario"]="a".$_POST['Codigo'];
                        $_SESSION["senha"]=$_POST['Senha'];
			header("Location:ReservaController.php");                       
			exit();
		}
		 echo "<script type=\"text/javascript\">alert('Usuário ou senha inválidos');location.href='Login.html';</script>";
		 
	?>