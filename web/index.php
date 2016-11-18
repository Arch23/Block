<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./view/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./view/css/common.css">
   <link rel="stylesheet" type="text/css" href="./view/css/index.css">
	<script src="./view/jquery/jquery-1.12.4.min.js"></script>
	<script src="./view/jquery/bootstrap.min.js"></script>
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
        			$("#Modal").modal();
        		}
        		else{
        		    //alert("Prossiga com login");
        			location.href="view/Home.php";
        		}
       		 });

		});
	}
	</script>
</head>
<body>

	<div class="fundo2">
		<h2 class="h2">Sistema de salas</h2>
		<h3 class="h3">Digite seus dados</h2>
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
							<a class="btn btn-default" href="view/Cadastrar.php" role="button">Cadastrar</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- Modal -->
	  <div class="modal fade" id="Modal" role="dialog">
	    <div class="modal-dialog">    
	      <!-- Conteudo do modal-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Atenção</h4>
	        </div>
	        <div id="MensagemModal" class="modal-body">
	        	<p>Usuário ou Senha Inválidos!</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	        </div>
	      </div>
	      
	    </div>
	  </div> 
    <!-- Fim do Modal --> 
	</body>
</html>
