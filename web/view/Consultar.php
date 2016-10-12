<!DOCTYPE html>
<html lang="en">
<?php
session_start();
date_default_timezone_set ("America/Sao_Paulo");
?>
<head>
  <title>Consultar</title>
  <meta charset="utf-8">
  <meta  content="width=970px, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./css/common.css">
  <link rel="stylesheet" type="text/css" href="./css/Consultar.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./jquery/jquery.click-calendario-1.0-min.js"></script>
  <link href="./css/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
  <script>
   $(document).ready(function(){
        $('#calendar').focus(function(){
         $(this).calendario({
            target:'#calendar'
         });
      });
      var dt= new Date();
      var ano=dt.getFullYear();
      var dia=dt.getDate();
      if(dia<10){
        dia= "0"+dia;
      }
      var mes=dt.getMonth()+1;
      if(mes<10){
        mes= "0"+mes;
      }
      document.getElementById("calendar").value = dia +"/" + mes+ "/"+ ano;
   });
   </script>

    <script>
     $(document).ready(function(){
    $('#Bloco').change(function(){
    $(document).ready(function(){
          $.post("../controller/ReservaController.php",
           {
              Tag: 1,
              Bloco: $("#Bloco option:selected").text(),
          },
          function(data,status){
            document.getElementById("Salas").innerHTML = data;
           });
    });
  });
});
  </script>
  <script>
  	function gotoConsulta(){
  		 $(document).ready(function(){
          $.post("../controller/ConsultarController.php",
           {
              Bloco: $("#Bloco option:selected").text(),
              Sala:  $("#Salas option:selected").text(),
              Datadia: $("#calendar").val()
          },
          function(data,status){
            document.getElementById("Tabela").innerHTML = data;
           });
   		 });
	}
  </script>
</head>
<body>
  <!--BARRA DE NAVEGAÇÃO-->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
       <a class="navbar-brand" href="#">S.G.S.</a>
     </div>
     <ul class="nav navbar-nav">
       <li><a href="Home.php">Home</a></li>
       <li><a href="Reservar.php">Reservar</a></li>
       <li class="active"><a href="Consultar.php">Consultar</a></li>
       <li><a href="Historico.html">Histórico</a></li>
     </ul>

     <ul class="nav navbar-nav navbar-right">
      <!-- <li><a href="#">OPÇÃO DE LINK 0</a></li>-->
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opções <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="Configuracoes.html">Configurações</a></li>
          <li><a href="Ajuda.html">Ajuda</a></li>
          <!--<li><a href="#">OPÇÃO DE LINK 2</a></li>-->
          <li role="separator" class="divider"></li>
          <li><a href="../controller/SairController.php">Sair</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav><!--  FIM  BARRA DE NAVEGAÇÃO-->

<div class="fundo3">
   <h3 class="h3">Consulta de Horários</h3>
   <div class="blocks">
      <h5 class="sub-h">Bloco: </h5>
      <select id="Bloco" class="dropdown-list">
         <?php
          include("../model/ReservaDAO.php");
          $obj=new ReservaDAO($_SESSION["usuario"],$_SESSION["senha"]);
          $obj->retornaBlocos();
        ?>
      </select>
   </div>
   <div class="blocks">
      <h5 class="sub-h">Sala: </h5>
      <select id="Salas" class="dropdown-list">
        <?php
        $obj->retornaSalas("BLOCO 1");
        ?>
      </select>
    </div>
   <div class="blocks">
         <h5 class="sub-h">Data: </h5>
         <input class="calendar" type="text" name="calendar" id="calendar" size="10" maxlength="10"/>
         <button type="button" onclick="gotoConsulta();return false;" class="btn btn-default">Pesquisar</button>
      </div>
      <div class="clearfix"> </div>
      <table id="Tabela" class="tg">
      <?php
      $coduser=$_SESSION["usuario"];
          $obj->retornaReservaNormal("BLOCO 1",1,1,(date("d"))."/".date("m")."/".date("Y"),$coduser);
      ?>
      </table>
</div>
</body>
</html>
