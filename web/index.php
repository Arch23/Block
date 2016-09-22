<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./view/css/common.css">
   <link rel="stylesheet" type="text/css" href="./view/css/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
	function gotoLogin(){
		$(document).ready(function(){
      	  $.post("controller/LoginController.php",
       		 {
        	    Codigo: $("#Codigo").val(),
          		Senha:  $("#Senha").val()
        	},
        	function(data,status){
        		if(data.search("nao")>0){
        			alert("Usuário ou Senha Inválidos!");
        		}
        		else{
        		//	alert("Prossiga com login");
        			location.href="view/Reservar.html";
        		}
       		 });	
        	
		});
	}
	</script>
</head>
<body>

	<div id="fundo2">
		<h2 id="H2">Sistema de salas</h2>
		<h3 id="h3">Digite seus dados</h2>
			<div class="itens">
				<form onsubmit="gotoLogin();return false;" id="target" class="form-horizontal">
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
							<a class="btn btn-default" href="view/Cadastrar.html" role="button">Cadastrar</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
