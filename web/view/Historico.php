<!DOCTYPE html>
<html lang="en">
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
   <script>
   function carregaTabela(){ //Starta a API
      $(document).ready(function() {
         $("#Tabela").dataTable().fnDestroy(); //Destroi a tabela antiga
         var table = $('#Tabela').DataTable( { //Inicialização da tabela da api
            dom: 'tp', //Modelo da tabela
            "iDisplayLength":50 //Excpande o máximo de entradas
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
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
         </select>
      </div>
      <div class="blocks">
         <h5 class="sub-h">Sala: </h5>
         <select id="Salas" class="dropdown-list">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
         </select>
      </div>
      <div class="blocks">
         <h5 class="sub-h">Data: </h5>
         <input class="calendar" type="text" name="calendar" id="calendar" size="10" maxlength="10" value/>
         <button type="button" onclick="gotoConsulta();return false;" class='reservar-button btn btn-default'>Pesquisar</button>
      </div>
      <div class="clearfix"> </div>
      <table id="Tabela" class="display">
         <thead>
            <tr>
               <th style="color:white;">Data</th>
               <th style="color:white;">Sala</th>
               <th style="color:white;">Horário de Inicio</th>
               <th style="color:white;">Horário de Termino</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Row 1, Cell 1</td>
               <td>Row 1, Cell 2</td>
               <td>Row 1, Cell 3</td>
               <td>Row 1, Cell 4</td>
            </tr>
            <tr>
               <td>Row 2, Cell 1</td>
               <td>Row 2, Cell 2</td>
               <td>Row 2, Cell 3</td>
               <td>Row 2, Cell 4</td>
            </tr>
            <tr>
               <td>Row 3, Cell 1</td>
               <td>Row 3, Cell 2</td>
               <td>Row 3, Cell 3</td>
               <td>Row 3, Cell 4</td>
            </tr>
         </tbody>
      </table>
   </div>

</body>
</html>
