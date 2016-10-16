<!DOCTYPE html>
<html lang="en">
<?php
session_start(); //Puxa os dados da sessão para a pagina
date_default_timezone_set ("America/Sao_Paulo");
?>
<head>
  <title>Reservar</title>
   <meta charset="utf-8">
   <meta  content="width=970px, initial-scale=1">
   <link rel="stylesheet" href="./css/bootstrap.min.css">
   <link href="./css/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
   <link href="./datatables/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
   <link href="./datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" type="text/css" href="./css/common.css">
   <link rel="stylesheet" type="text/css" href="./css/Reservar.css">
   <script src="./jquery/jquery-1.12.4.min.js"></script>
   <script src="./jquery/bootstrap.min.js"></script>
   <script type="text/javascript" src="./jquery/jquery.click-calendario-1.0-min.js"></script>
   <script src="./datatables/jquery.dataTables.min.js"></script>
   <script src="./datatables/dataTables.select.min.js"></script>
   <link rel="stylesheet" type="text/css" href="./datatables/select.dataTables.min.css">
   <script type="text/javascript" language="javascript" src="./datatables/dataTables.buttons.min.js">
   </script>
   <script>
   $(document).ready(function(){ //Starta o calendário
      $('#calendar').focus(function(){
         $(this).calendario({
            target:'#calendar'
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
   });
   </script>
   <script> //Controla o list dos blocos e salas
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
               gotoConsulta();
            });
         });
      });
   });
   </script>
    <script> //Controla o list dos blocos e salas
   $(document).ready(function(){
      $('#Salas').change(function(){
         $(document).ready(function(){
          gotoConsulta();
         });
      });
   });
   </script>   
   <script>
   function gotoConsulta(){ //Realiza a consulta para determinada sala e data
      $(document).ready(function(){
         $.post("../controller/ReservaController.php",
         {
            Tag: 2,
            Bloco: $("#Bloco option:selected").text(), //Manda informações via post
            Sala:  $("#Salas option:selected").text(),
            Datadia: $("#calendar").val()
         },
         function(data,status){
            document.getElementById("Tabela").innerHTML = data; //Altera a tabela
            carregaTabela(); //Inicializa a API
         });
      });
   }
   </script>
   <script>
   function carregaTabela(){ //Starta a API
      $(document).ready(function() {
         $("#Tabela").dataTable().fnDestroy(); //Destroi a tabela antiga
         var table = $('#Tabela').DataTable( { //Inicialização da tabela da api
            dom: 'frtipB', //Modelo da tabela
            ordering: false, //Remove ordenação, paginação, barra de busca e etc
            paginate: false,
            bFilter:false,
            bInfo:false,
            select:{ //Modo de seleção de celulas
               style: 'os', //Permite selecionar várias celulas
               items: 'cell' //Seta para a  seleção de celulas
            },
            "iDisplayLength":50, //Excpande o máximo de entradas
            buttons: [  //Seta o botão referente a tabela
               {
                  text: 'Reservar', //Texto do  botão
                  action: function () {
                     var recorrencia=prompt("Deseja Reservar Por Quantas Semanas?\nCaso seja deixado em branco o valor padrão é 1");
                     if(recorrencia==null||recorrencia==""){
                        recorrencia=1;
                     }
                     var reserv = table.cells( { selected: true } ).data(); //Armazena os dados das celulas na váriavel reserv
                     var i=0; //starta o contador
                     var dadosreserv=[]; //Starta o array
                     for(i=0;i<reserv.length;i++){ //Filtra o array de reserva
                        dadosreserv.push(reserv[i]);
                     }
                     var st = JSON.stringify(dadosreserv);  //Transforma o array em uma string
                     $.post("../controller/ReservaController.php",
                     {
                        Tag: 3, //Envia os dados atraves do post
                        dadosreserv: st,
                        Bloco: $("#Bloco option:selected").text(),
                        Sala:  $("#Salas option:selected").text(),
                        Recorrencia: recorrencia
                     },
                     function(data,status){
                        gotoConsulta(); //Chama a consulta e inicializa a tabela novamente
                        alert(data); //Alerta o resultado obtido
                     });                    
                  }
               }
            ]
         } );
      } );
   }
   carregaTabela(); //Chama a função ao carregar a pagina para garantir que a tabela seja inicializada
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
         <input class="calendar" type="text" name="calendar" id="calendar" size="10" maxlength="10" value/>
         <button type="button" onclick="gotoConsulta();return false;" class='reservar-button btn btn-default'>Pesquisar</button>
      </div>
      <div class="clearfix"> </div>
      <table id="Tabela" class="display">
         <?php
         $coduser=$_SESSION["usuario"];
         $obj->retornaReservaNormal("BLOCO 1",1,1,(date("d"))."/".date("m")."/".date("Y"),$coduser);
         ?>
      </table>
   </div>


   <!--
   <div class="page-header">
   <h1>Atualiações</h1>
</div>
-->
</body>
</html>
