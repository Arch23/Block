<!DOCTYPE html>
<html lang="en">
<?php
session_start(); //Puxa os dados da sessão para a pagina
date_default_timezone_set ("America/Sao_Paulo");
?>
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta content="width=970px, initial-scale=1">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/Home.css">
   <script src="./jquery/jquery-1.12.4.min.js"></script>
    <script src="./jquery/bootstrap.min.js"></script>
    <script> //Exibe o nome de usuário
   $(document).ready(function(){
      $(document).ready(function(){
            $.post("../controller/HomeController.php",
            {
               Tag: 1
            },
            function(data,status){
               document.getElementById("nomeUsuario").innerHTML = data;
            });
         });
   });
   </script>
   <script>
    $(document).ready(function(){
        $("button").click(function(){
         $("#"+$(this).attr('id')).hide();
                  $.post("../controller/HomeController.php",
                 {
                    Tag:2,
                    Sala: document.getElementById($(this).attr('id')+"sala").innerHTML,
                    Data: document.getElementById($(this).attr('id')+"data").innerHTML,
                    Horario:document.getElementById($(this).attr('id')+"horario").innerHTML
                },
                function(data,status){
                     alert(data);
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
               <li class="active"><a href="#">Home</a></li>
               <li><a href="Reservar.php">Reservar</a></li>
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
   </nav>
   <!--  FIM  BARRA DE NAVEGAÇÃO-->

    <div class="col-sm-8 text-left div-user">
        <h3 style="color: #FFFFFF;">Bem-vindo</h3>
        <p id="nomeUsuario" style="color:#FFFFFF;"></p>
    </div>

    <div class="fundo3">
        <div class="div-titulo">
            <h2 class="titulo">Suas reservas:</h2>
        </div>
        <hr style="border: 2px dashed black; width: 99%;" />
        <?php
            include("../model/UserDAO.php");
            $obj=new UserDAO("localhost",$_SESSION["usuario"],$_SESSION["senha"],"roomz");
            $obj->retornaReservasUser();
        ?>
    </div>
    <!--
    <div class="page-header">
          <h1>Atualiações</h1>
    </div>
  -->
</body>

</html>
