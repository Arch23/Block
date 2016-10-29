<!DOCTYPE html>
<html lang="en">
<?php
   session_start();
   date_default_timezone_set ("America/Sao_Paulo");
?>
<head>
   <title>Histórico</title>
   <meta charset="utf-8">
   <meta  content="width=970px, initial-scale=1">
   <link rel="stylesheet" href="./css/bootstrap.min.css">
   <link href="./css/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
   <link href="./datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" type="text/css" href="./css/common.css">
   <link rel="stylesheet" type="text/css" href="./css/Reservar.css">
   <script src="./jquery/jquery-1.12.4.min.js"></script>
   <script src="./jquery/bootstrap.min.js"></script>
   <script type="text/javascript" src="./jquery/jquery.click-calendario-1.0-min.js"></script>
   <script src="./datatables/jquery.dataTables.min.js"></script>
   <script>
   $(document).ready(function(){ //Starta o calendário
      $('#calendar').focus(function(){
         $(this).calendario({
            target:'#calendar'
         });
      });
        $('#calendar2').focus(function(){
         $(this).calendario({
            target:'#calendar2'
         });
      });
      var dt= new Date();// Manipulações para exibir a data do diia na caixa de texto.
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
      document.getElementById("calendar2").value = dia +"/" + mes+ "/"+ ano;
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
               document.getElementById("Salas").innerHTML = '"<option value="TODOS" class="dropdown-contet">TODAS</option>"'+data;
               gotoConsulta();
            });
         });
      });
   });
   </script>
    <script>
      $(document).ready(function(){
      $('#Salas').change(function(){
        gotoConsulta();
      });
   });
   </script>
   <script>
   function carregaTabela(){ //Starta a API
      $(document).ready(function() {
         $("#Tabela").dataTable().fnDestroy(); //Destroi a tabela antiga
         var table = $('#Tabela').DataTable( { //Inicialização da tabela da api
            dom: 'tp', //Modelo da tabela
            "iDisplayLength":20 //Excpande o máximo de entradas
         } );
      } );
   }
   carregaTabela(); //Chama a função ao carregar a pagina para garantir que a tabela seja inicializada
   </script>
   <script>
      function gotoConsulta(){
         if($("#Salas option:selected").text()=="TODAS"){
            $.post("../controller/HistoricoController.php",
            {
               Tag: 1,
               Bloco: $("#Bloco option:selected").text(),
               DataInicio: $("#calendar").val(),
               DataTermino:$("#calendar2").val() 
            },
            function(data,status){
             document.getElementById("Tabela").innerHTML = data;
             carregaTabela();
            });
         }else{
            $.post("../controller/HistoricoController.php",
            {
               Tag: 2,
               Bloco: $("#Bloco option:selected").text(),
               DataInicio: $("#calendar").val(),
               DataTermino:$("#calendar2").val(),
               Sala:$("#Salas option:selected").text() 
            },
            function(data,status){
             document.getElementById("Tabela").innerHTML = data;
             carregaTabela();
            });            
         }         
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
            <li class="active"><a href="Historico.php">Histórico</a></li>
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
      <h3 class="h3">Histórico</h3>
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
         <option value="TODOS" class="dropdown-contet">TODAS</option>
            <?php
            $obj->retornaSalas("BLOCO 1");
            ?>
         </select>
      </div>
      <div class="blocks">
         <h5 class="sub-h">Data: </h5>
         <input class="calendar" type="text" name="calendar" id="calendar" size="10" maxlength="10" value/>
         <input class="calendar" type="text" name="calendar" id="calendar2" size="10" maxlength="10" value/>
         <button type="button" onclick="gotoConsulta();return false;" class='reservar-button btn btn-default'>Pesquisar</button>
      </div>
      <div class="clearfix"> </div>
      <table id="Tabela" class="display">
         <thead>
            <tr>
               <th style="color:white;">Data</th>
               <th style="color:white;">Sala</th>
               <th style="color:white;">Horário de Inicio</th>
            </tr>
         </thead>
         <tbody id="InfosTabela">
            <?php
               include("../model/HistoricoDAO.php");
               $obj=new HistoricoDAO($_SESSION["usuario"],$_SESSION["senha"]);
               $obj->retornaHistorico((date("d"))."/".date("m")."/".date("Y"),
                  (date("d"))."/".date("m")."/".date("Y"),"BLOCO 1");
            ?>
         </tbody>
      </table>
   </div>

</body>
</html>
