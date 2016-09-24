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
       <li class="active"><a href="Reservar.php">Reservar</a></li>
       <li><a href="Consultar.php">Consultar</a></li>
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
      <select id="Bloco" class="dropdown-list">    
         <?php
          include("../model/ReservaDAO.php");
          $obj=new ReservaDAO();
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
      </div>
      <div class="clearfix"> </div>
      <table class="tg">
         <tr>
            <th class="tg-baqh"></th>
            <th class="tg-yw4l">Início</th>
            <th class="tg-yw4l">Término</th>
            <th class="tg-yw4l">Segunda</th>
            <th class="tg-yw4l">Terça</th>
            <th class="tg-yw4l">Quarta</th>
            <th class="tg-yw4l">Quinta</th>
            <th class="tg-yw4l">Sexta</th>
            <th class="tg-yw4l">Sábado</th>
         </tr>
         <tr>
            <td class="tg-yw4l">M1</td>
            <td class="tg-yw4l">07h30</td>
            <td class="tg-yw4l">08h20</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">M2</td>
            <td class="tg-yw4l">08h20</td>
            <td class="tg-yw4l">09h10</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">M3</td>
            <td class="tg-yw4l">09h10</td>
            <td class="tg-yw4l">10h00</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">M4</td>
            <td class="tg-yw4l">10h20</td>
            <td class="tg-yw4l">11h10</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">M5</td>
            <td class="tg-yw4l">11h10</td>
            <td class="tg-yw4l">12h00</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">M6</td>
            <td class="tg-yw4l">12h00</td>
            <td class="tg-yw4l">12h50</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">T1</td>
            <td class="tg-yw4l">13h00</td>
            <td class="tg-yw4l">13h50</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">T2</td>
            <td class="tg-yw4l">13h50</td>
            <td class="tg-yw4l">14h40</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">T3</td>
            <td class="tg-yw4l">14h40</td>
            <td class="tg-yw4l">15h30</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">T4</td>
            <td class="tg-yw4l">15h50</td>
            <td class="tg-yw4l">16h40</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">T5</td>
            <td class="tg-yw4l">16h40</td>
            <td class="tg-yw4l">17h30</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">T6</td>
            <td class="tg-yw4l">17h50</td>
            <td class="tg-yw4l">18h40</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">N1</td>
            <td class="tg-yw4l">18h40</td>
            <td class="tg-yw4l">19h30</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">N2</td>
            <td class="tg-yw4l">19h30</td>
            <td class="tg-yw4l">20h20</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">N3</td>
            <td class="tg-yw4l">20h20</td>
            <td class="tg-yw4l">21h10</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">N4</td>
            <td class="tg-yw4l">21h20</td>
            <td class="tg-yw4l">22h10</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
         <tr>
            <td class="tg-yw4l">N5</td>
            <td class="tg-yw4l">22h10</td>
            <td class="tg-yw4l">22h00</td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
         </tr>
      </table>
</div>

<!--
  <div class="page-header">
        <h1>Atualiações</h1>
  </div>
-->
</body>
</html>
