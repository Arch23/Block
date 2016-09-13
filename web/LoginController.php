	<?php
		include("UserDAO.php");
	
		$obj= new UserDAO();	
		$conn=$obj->conectaBanco("localhost",$_POST['Codigo'],$_POST['Senha'],"roomz");
		if(!$conn->connect_error){
			header("Location:Reservar.html");
			exit();
		}
		 echo "<script type=\"text/javascript\">alert('Usuário ou senha inválidos');location.href='Login.php';</script>";
		 
	?>