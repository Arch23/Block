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
				<a class="navbar-brand" href="Home.php">ROOMZ</a>
			</div>
			<ul class="nav navbar-nav">
				<!-- <li class="active"><a href="#">Home</a></li>-->
				<li><a href="Reservar.php">Home</a></li>
				<li><a href="Reservar.php">Reservar</a></li>
				<li><a href="Historico.php">Histórico</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<!-- <li><a href="#">OPÇÃO DE LINK 0</a></li>-->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opções <span class="caret"></span></a>
					<ul class="dropdown-menu">
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
	<br/>
	<div class="div-titulo">
		<h2 class="titulo">Como utilizar o sistema:</h2>
	</div>
	<hr style="border: 2px dashed black; width: 99%;" />
		<div class="panel-group" id="accordion">
			<h3 class="faqHeader subtitulo">Duvidas prequentes</h3>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">O que é ROOMZ??</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse in">
					<div class="panel-body">
						ROOMZ é um sistema utilizado para gerenciar reservas de ambientes, no qual o usuário poderá reservar o ambiente pela internet ou presencialmente, pelo meio de um RFID.
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Uma sala está livre, mas não consigo reservar!</a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse">
					<div class="panel-body">
						Primeiramente deve-se verificar os tipos de restrições do seu usuário. Alunos não podem reservar salas, e professores podem reservar as salas que pertencem ao seu departamento e, também, salas que não pertencem a nenhum departamento(Ex: Professores de Computação não podem reservar salas e laboratórios de Química).
						Em seguida, conferir se o dia em que pretende reservar não é um dia indisponível(Dias do mês que já passaram).
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Como posso excluir/cancelar uma reserva?</a>
					</h4>
				</div>
				<div id="collapseThree" class="panel-collapse collapse">
					<div class="panel-body">
						Ao concluir a reserva de um ambiente, o sistema ROOMZ gera automáticamente um bloco de lembrete que é adicionado à pagina inicial do usuário no sistema.
						<br/>
						<img src="C:\Users\Gabriela\Documents\GitHub\ProjetosGit\Block\web\view\Img\inicio.png"  id="center"/>
						<br/>
						Nesse bloco ficam visíveis as informações da reserva feita por um usuário, para lembrá-lo da reserva que fez. No fim do bloco há um botão "X", que ao ser pressionado gera a exclusão da reserva e do bloco. Uma vez excluída, a ação não pode ser revertida, mas o ambiente está novamente livre no dia e no horário que estava ocupado, sendo passível de uma nova reserva.
					</div>
				</div>
			</div>

		<br/>
		<h3 class="faqHeader subtitulo">Funcionamento do sistema</h3>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour"> Como reservar um ambiente</a>
				</h4>
			</div>
			<div id="collapseFour" class="panel-collapse collapse">
				<div class="panel-body">
					O usuário poderá reservar  de duas maneiras:
					<ol>
						<li><strong>Presencialmente:</strong></li>

						Por meio de um cartão RFID, é possivel reservar um ambiente por um determinado período de tempo.
						Este método é utilizado para reservar salas disponíveis presencialmente, sem o acesso ao sistema pela internet.
						Para reservar um ambiente, basta aproximar o cartão do leitor RFID e se ele estiver livre, o ambiente estará reservado.
						<br/>
						<img src="C:\Users\Gabriela\Documents\GitHub\ProjetosGit\Block\web\view\Img\roomz1.png"  id="center"/>
						<br/>


						<li><strong>Pelo sistema online:</strong></li>
						Na página de reservas, seleciona-se o bloco e a sala do ambiente desejado, bem como a data e os horários requeridos, de acordo com a disponibilidade dos mesmos.
						<br/>
						<img src="C:\Users\Gabriela\Documents\GitHub\ProjetosGit\Block\web\view\Img\roomz2.png" id="center" />
						<br/>
						<img src="C:\Users\Gabriela\Documents\GitHub\ProjetosGit\Block\web\view\Img\reservar1.png"  id="center"/>
						<br/>


					</ol>
				</div>
			</div>
		</div>


		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Como consultar se uma sala está reservada?</a>
				</h4>
			</div>
			<div id="collapseFive" class="panel-collapse collapse">
				<div class="panel-body">
					Através da página de reservas, seleciona-se o bloco e a sala do ambiente desejado, bem como a data e os horários que se deseja consultar. Sobre cada horário da grade, está escrito o estado do ambiente, para o dia selecionado.
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">O que são os estados de um ambiente?</a>
				</h4>
			</div>
			<div id="collapseSix" class="panel-collapse collapse">
				<div class="panel-body">
					Os possiveis estados de um ambiente são:
					<ul>
						<li style="color:blue">Livre</li> Pode ser reservado
						<li style="color:red">Reservado</li> Já está reservado
						<li style="color:grey">Horários Indisponíveis</li> Dias que já passaram
					</ul>
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">Quantos horários posso reservar?</a>
				</h4>
			</div>
			<div id="collapseSeven" class="panel-collapse collapse">
				<div class="panel-body">
					Todos os horários disponíveis na grade de horários são passíveis de reserva, tanto para apenas uma vez(dado o dia selecionado), quanto uma reserva recorrente para até 3 semanas seguintes(sempre no mesmo dia da semana e no mesmo horário) se essa opção for selecionada ao se fazer a reserva.
				</div>
			</div>
		</div>


		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight">Quais são os tipos de usuário presentes no sistema?</a>
				</h4>
			</div>
			<div id="collapseEight" class="panel-collapse collapse">
				<div class="panel-body">
					Os tipos de usuário são: Aluno ou professor(Sendo que alguns professores podem ser responsáveis por um departamento).
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNine">Quais são as restrições que cada usuário possui no sistema?</a>
				</h4>
			</div>
			<div id="collapseNine" class="panel-collapse collapse">
				<div class="panel-body">
					Diferentes tipos de usuários podem realizar diferentes tarefas no sistema.
					<ul>
						<li><strong>Alunos:</strong> Podem observar os estados dos ambientes. Porém não possuem permissão para realizar nenhuma reserva.</li>

						<li><strong>Professores:</strong> Podem oberservar o estado de qualquer ambiente. Podem fazer reservas de ambientes que pertencem ao seu próprio departamento(ex: mecânica) e ambientes que não pertencem a departamento nenhum(ex: salas de aula).</li>
					</ul>
				</div>
			</div>
		</div>

	</div>
</div>
</div>

</body>

</html>
