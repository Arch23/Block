<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
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
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
  <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js">
  </script>
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
          $.post("../controller/ReservaController.php",
           {
              Tag: 2,
              Bloco: $("#Bloco option:selected").text(),
              Sala:  $("#Salas option:selected").text(),
              Datadia: $("#calendar").val()
          },
          function(data,status){
             document.getElementById("Tabela").innerHTML = data;
             carregaTabela();
           });
       });
  }
  </script>
  <script>
  function carregaTabela(){
  $(document).ready(function() {
    $("#Tabela").dataTable().fnDestroy();
    var table = $('#Tabela').DataTable( {
        dom: 'Bfrtip',
        select:{
          style: 'os',
          items: 'cell'
        },
         "iDisplayLength":50,
        buttons: [
            {
                text: 'Reservar',
                action: function () {
                    var reserv = table.cells( { selected: true } ).data();
                    var i=0;
                    var dadosreserv=[];
                    for(i=0;i<reserv.length;i++){
                      dadosreserv.push(reserv[i]);                      
                    }
                    var st = JSON.stringify(dadosreserv);
                       $.post("../controller/ReservaController.php",
                               {
                                   Tag: 3,
                                    dadosreserv: st,
                                    Bloco: $("#Bloco option:selected").text(),
                                    Sala:  $("#Salas option:selected").text()
                                },
                               function(data,status){                               
                                alert(data);
                               });
                               gotoConsulta();   
                }
            }
        ]
    } );
  } );
}
carregaTabela();
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
         <input class="calendar" type="text" name="calendar" id="calendar" size="10" maxlength="10" value/>
           <button type="button" onclick="gotoConsulta();return false;">Pesquisar</button>
      </div>
      <div class="clearfix"> </div>
      <table id="Tabela" class="display">
          <?php
          $coduser=$_SESSION["usuario"];
          $obj->retornaReservaNormal("BLOCO 1",1,1,(date("d")-1)."/".date("m")."/".date("Y"),$coduser);
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
