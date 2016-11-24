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
   <script type="text/javascript" language="javascript" src="./datatables/dataTables.buttons.min.js"></script>
   <script>var table=null;</script>
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
         table = $('#Tabela').DataTable( { //Inicialização da tabela da api
            dom: 'frtip', //Modelo da tabela
            ordering: false, //Remove ordenação, paginação, barra de busca e etc
            paginate: false,
            bFilter:false,
            bInfo:false,
            select:{ //Modo de seleção de celulas
               style: 'os', //Permite selecionar várias celulas
               items: 'cell' //Seta para a  seleção de celulas
            },
            "iDisplayLength":50 //Excpande o máximo de entradas
         } );
      } );
   }
   carregaTabela(); //Chama a função ao carregar a pagina para garantir que a tabela seja inicializada
   </script>
   <script>
    function liberar(){
                    var  recorrencia=$("#Recorrencia option:selected").val();
                     var reserv = table.cells( { selected: true } ).data(); //Armazena os dados das celulas na váriavel reserva
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
                        if(!data==""){
                        document.getElementById("MensagemModal").innerHTML = data; //Coloca os dados dentro do primeiro modal
                        $("#Modal").modal();
                        }else{
                           document.getElementById("MensagemModal").innerHTML = "Nenhum Horário foi Reservado! Verifique suas opções escolhidas!";
                           $("#Modal").modal();
                        }
                     });
    }
   </script>
   <script>
   function chamaModal(){
      $("#Reserva-Modal").modal();
   }
   </script>

</head>
<body>
   <!--BARRA DE NAVEGAÇÃO-->
   <nav class="navbar navbar-inverse">
      <div class="container-fluid">
         <div class="navbar-header">
            <a class="navbar-brand" href="Home.php">ROOMZ</a>
         </div>
         <ul class="nav navbar-nav">
            <li><a href="Home.php">Home</a></li>
            <li class="active"><a href="Reservar.php">Reservar</a></li>
            <li><a href="Historico.php">Histórico</a></li>
         </ul>

         <ul class="nav navbar-nav navbar-right">
            <!-- <li><a href="#">OPÇÃO DE LINK 0</a></li>-->
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opções <span class="caret"></span></a>
               <ul class="dropdown-menu">
                  <li><a href="Ajuda.php">Ajuda</a></li>
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
      </div>
      <div class="blocks">
         <h5 class="sub-h" style="color:#1a1a1a">Lorem Ipsum</h5>
         <button type="button" onclick="gotoConsulta();return false;" class='reservar-button btn btn-default'>Pesquisar</button>
      </div>
      <div class="clearfix"> </div>
      <div class="btn-position">
         <button onclick="chamaModal();" type="button" class="btn btn-default">Reservar</button>
      </div>
      <table id="Tabela" class="display">
         <?php
         $coduser=$_SESSION["usuario"];
         $obj->retornaReservaNormal("BLOCO 1",1,1,(date("d"))."/".date("m")."/".date("Y"),$coduser);
         ?>
      </table>
      <div class="btn-position">
        <button onclick="chamaModal();" type="button" class="btn btn-default">Reservar</button>
       </div>
   </div>
  <!-- Modal -->
  <div class="modal fade" id="Modal" role="dialog">
    <div class="modal-dialog">
      <!-- Conteudo do modal-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Resumo de horários reservados</h4>
        </div>
        <div id="MensagemModal" class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>

    </div>
  </div>
    <!-- Fim do Modal -->
    <div class="modal fade" id="Reserva-Modal" role="dialog">
      <div class="modal-dialog">
        <!-- Conteudo do modal-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Confirmação de Reservas</h4>
          </div>
          <div  class="modal-body">
             <p>
                Deseja Reservar Por Quantas Semanas?
                <br />
             </p>
             <form class="" action="index.html" method="post">
                <select id="Recorrencia">
                   <option value="1">1</option>
                   <option value="2">2</option>
                   <option value="3">3</option>
                   <option value="4">4</option>
                </select>
             </form>
          </div>
          <div class="modal-footer">
            <button onclick="liberar();" id="Confirmar" type="button" class="btn btn-default" data-dismiss="modal">Confirmar</button>
          </div>
        </div>

      </div>
    </div>
</body>
</html>
