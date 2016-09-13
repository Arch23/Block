<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
[cc lang=”css”]{ /*Responsividade para desktops and laptops ———– */
	Styles 
	@media only screen
	and (min-width : 1224px)
}
body{
	background-color: #99ffeb;
}
#H2{
	margin-left:28%;
	margin-top:5%;
	font-family: Times New Roman;
	font-size: 350%;
	color: #ffffff;
	z-index: = 10000;
}
#h3{
	font-family: Times New Roman;
	font-size: 150%;
	margin-left:40%;
	color: #b3b3b3;
	z-index: = 10000;
}

.form-horizontal{
	margin-left:12%;
	margin-top:4%;
}

#fundo2{
	position: absolute;
	top: 0px;
	z-index: 0;
	height: 65% ; 
	width:50% ;
	border-radius: 1%;
	background-color: #1a1a1a;
	margin-left:25%;
	margin-top:0%;
}
.itens{
	position: relative;
	top: 6%;
	z-index: = 10000;
}
.col-sm-2{
	color:#ffffff;
}
.checkbox{
	color: #b3b3b3;
}
a{
	margin-left: 5%;
	text-decoration: none;
	color:#000000;
}
a:hover , a:active {
	text-decoration: none;
	color: #000000;
}
</style>
<body>

	<div id="fundo2">  
		<h2 id="H2">Sistema de salas</h2>
		<h3 id="h3">Digite seus dados</h2>
			<div class="itens">
				<form action= "LoginController.php" method="POST" class="form-horizontal">
					<div class="form-group">
						<label for="Codigo" class="col-sm-2 control-label">Código</label>
						<div class="col-sm-8">
							<input type="text" name ="Codigo" class="form-control" id="Codigo" placeholder="Código" >
						</div>
					</div>
					<div class="form-group">
						<label for="Senha" class="col-sm-2 control-label">Senha</label>
						<div class="col-sm-8">
							<input type="password" name="Senha" class="form-control" id="Senha" placeholder="Senha">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<label>
									<input type="checkbox"> Lembrar
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" value="Entrar" class="btn btn-default">Entrar</button> 						
							<a class="btn btn-default" href="Cadastrar.html" role="button">Cadastrar</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>