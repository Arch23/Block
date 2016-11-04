<!DOCTYPE html>
<html lang="en">
<?php
session_start(); //Puxa os dados da sessão para a pagina
date_default_timezone_set ("America/Sao_Paulo");
?>
<head>
	<title>Ajuda</title>
	<meta charset="utf-8">
	<meta content="width=970px, initial-scale=1">
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/Ajuda.css">
	<script src="./jquery/jquery-1.12.4.min.js"></script>
	<script src="./jquery/bootstrap.min.js"></script>

</head>

<body>

	<!--BARRA DE NAVEGAÇÃO-->
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">S.G.A.</a>
			</div>
			<ul class="nav navbar-nav">
				<!-- <li class="active"><a href="#">Home</a></li>-->
				<li><a href="Reservar.php">Home</a></li>
				<li><a href="Reservar.php">Reservar</a></li>
				<li><a href="Historico.php">Histórico</a></li>
				<li class="active"><a href="#">Ajuda</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<!-- <li><a href="#">OPÇÃO DE LINK 0</a></li>-->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opções <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="Configuracoes.html">Configurações</a></li>
						<li><a href="#">Ajuda</a></li>
						<!--<li><a href="#">OPÇÃO DE LINK 2</a></li>-->
						<li role="separator" class="divider"></li>
						<li><a href="../controller/SairController.php">Sair</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	<!--  FIM  BARRA DE NAVEGAÇÃO-->

	<!--<div class="col-sm-8 text-left div-user">
		<h3 style="color: #FFFFFF;">Bem-vindo</h3>
		<p id="nomeUsuario" style="color:#FFFFFF;"></p>
	</div>-->


	<div class="fundo3">
		<div class="div-titulo">
			<h2 class="titulo">Como utilizar o sistema:</h2>
		</div>
		<hr style="border: 2px dashed black; width: 99%;" />

		<div class="container">

			<div class="panel-group" id="accordion">
				<div class="faqHeader">Reservas</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Como reservar uma sala usando o sistema online?</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in">
						<div class="panel-body">
							RESPOSTA LALALALALALA 
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTen">PERGUNTA?</a>
						</h4>
					</div>
					<div id="collapseTen" class="panel-collapse collapse">
						<div class="panel-body">
							RESPOSTA LALALALALALA 
						</div>
					</div>
				</div>


				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">PERGUNTA?</a>
						</h4>
					</div>
					<div id="collapseEleven" class="panel-collapse collapse">
						<div class="panel-body">
							RESPOSTA LALALALALALA 
						</div>
					</div>
				</div>


				<div class="faqHeader">Tópico 2</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">PERGUNTA?</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse">
						<div class="panel-body">
							RESPOSTA LALALALALALA  <strong>LALALALALLA</strong>.
						</div>
					</div>
				</div>


				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">PERGUNTA?</a>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse">
						<div class="panel-body">
							RESPOSTA LALALALALALA 
							<ul>
								<li>LA</li>
								<li>LE</li>
								<li>LI</li>
								<li>LO</li>
							</ul>
						</div>
					</div>
				</div>


				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">PERGUNTA?</a>
						</h4>
					</div>
					<div id="collapseFive" class="panel-collapse collapse">
						<div class="panel-body">
							RESPOSTA LALALALALALA 
						</div>
					</div>
				</div>


				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">PERGUNTA?</a>
						</h4>
					</div>
					<div id="collapseSix" class="panel-collapse collapse">
						<div class="panel-body">
							RESPOSTA LALALALALALA 
						</div>
					</div>
				</div>


				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight">PERGUNTA?</a>
						</h4>
					</div>
					<div id="collapseEight" class="panel-collapse collapse">
						<div class="panel-body">
							RESPOSTA LALALALALALA 
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>

</body>

</html>
