<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reservar</title>
  <meta charset="utf-8">
  <meta  content="width=970px, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./css/common.css">
  <link rel="stylesheet" type="text/css" href="./css/Reservar.css">
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
   });
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
       <li><a href="Home.html">Home</a></li>
       <li class="active"><a href="Reservar.html">Reservar</a></li>
       <li><a href="Consultar.html">Consultar</a></li>
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
   <h3 class="h3">Reserva de Salas</h3>
   <div class="blocks">
      <h5 class="sub-h">Bloco: </h5>
      <select class="dropdown-list">    
         <?php
          include("../model/ReservaDAO.php");
          $obj=new ReservaDAO();
          $obj->retornaBlocos();
        //  echo "<html><option value="volvo" class="dropdown-contet">Volvo</option></html>";
        ?>    
      </select>
   </div>
   <div class="blocks">
      <h5 class="sub-h">Sala: </h5>
      <select class="dropdown-list">
         <option value="volvo" class="dropdown-contet">Volvo</option>
         <option value="saab" class="dropdown-contet">Saab</option>
         <option value="mercedes" class="dropdown-contet">Mercedes</option>
         <option value="audi" class="dropdown-contet">Audi</option>
      </select>      
   </div>
   <div class="blocks">
         <h5 class="sub-h">Data: </h5>
         <input class="calendar" type="text" name="calendar" id="calendar" size="10" maxlength="10"/>
      </div>
</div>

<!--
  <div class="page-header">
        <h1>Atualiações</h1>
  </div>
-->
</body>
</html>