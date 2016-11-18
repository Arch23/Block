<!DOCTYPE html>
<html lang="en">
<head>
   <title>Cadastro</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/common.css">
   <link rel="stylesheet" type="text/css" href="./css/Cadastrar.css">
   <script src="./jquery/jquery-1.12.4.min.js"></script>
   <script src="./jquery/bootstrap.min.js"></script>
   <script>
  function gotoCadastro(){
    $(document).ready(function(){
          $.post("../controller/CadastroController.php",
           {
              Codigo: $("#Codigo").val(),
              Nome:   $("#Nome").val(),
              Email:  $("#Email").val(),
              Departamento: $("#Departamento option:selected").text(),
              Tipo:   $("#Tipo option:selected").text(),
              Key:    $("#Key").val(),
              Senha:  $("#Senha").val()
          },
          function(data,status){
            if(data.search("criado")>=0){
              document.getElementById("MensagemModal").innerHTML="Usuário Já Existente!";
              $("#Modal").modal();
            }
            else if(data.search("sucesso")>=0){
              document.getElementById("MensagemModal").innerHTML="Usuário Criado com Suceso!";
              document.getElementById("localbotao").innerHTML='<button onclick= "gotoLogin();" type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>';
              $("#Modal").modal();
            }else{
              document.getElementById("MensagemModal").innerHTML="Erro ao criar usuário verifique seus dados e tente novamente!";
              $("#Modal").modal();
            }
           });

    });
  }
  </script>
  <script>
  function gotoLogin(){
    location.href="../index.php";
  }
  </script>

</head>
<body>
   <div class="fundo2">
      <h2 class="h2">Sistema de salas</h2>
      <h3 class="h3">Cadastro de um novo usuário</h2>
         <div class="itens">
            <form onsubmit="gotoCadastro();return false;" id="target" class="form-horizontal">

               <div class="form-group">
                  <label for="Codigo" class="col-sm-2 control-label">Código</label>
                  <div class="col-sm-8">
                     <input type="text" name ="Codigo" class="form-control" id="Codigo" placeholder="Código" >
                  </div>
               </div>

               <div class="form-group">
                  <label for="Nome" class="col-sm-2 control-label">Nome</label>
                  <div class="col-sm-8">
                     <input type="text" name ="Nome" class="form-control" id="Nome" placeholder="Nome" >
                  </div>
               </div>

               <div class="form-group">
                  <label for="Email" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-8">
                     <input type="email" name ="Email" class="form-control" id="Email" placeholder="Email" >
                  </div>
               </div>

               <div class="form-group">
                  <label for="Departamento" class="col-sm-2 control-label">Departamento</label>
                  <select id="Departamento" class="dropdown-cad form-control">
                    <?php
                        include("../model/UserDAO.php");
                        $obj=new UserDAO("localhost","root","","roomz");
                        $obj->retornaDepts();
                    ?>
                  </select>
               </div>

               <div class="form-group">
                  <label for="Tipo" class="col-sm-2 control-label">Tipo</label>
                  <select id="Tipo" class="dropdown-cad form-control">
                    <?php
                      $obj->retornaTipos();
                    ?>
                  </select>
               </div>

               <div class="form-group">
                  <label for="Key" class="col-sm-2 control-label">Key</label>
                  <div class="col-sm-8">
                     <input type="text" name ="Key" class="form-control" id="Key" placeholder="Chave do cartão" >
                  </div>
               </div>

               <div class="form-group">
                  <label for="Senha" class="col-sm-2 control-label">Senha</label>
                  <div class="col-sm-8">
                     <input type="password" name="Senha" class="form-control" id="Senha" placeholder="Senha">
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" value="Cadastrar" class="btn btn-default">Cadastrar</button>
                     <a class="btn btn-default" href="../index.php" role="button">Login</a>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!-- Modal -->
    <div class="modal fade" id="Modal" role="dialog">
      <div class="modal-dialog">    
        <!-- Conteudo do modal-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Atenção</h4>
          </div>
          <div class="modal-body">
            <p id="MensagemModal"></p>
          </div>
          <div id="localbotao" class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </div>
        
      </div>
    </div> 
    <!-- Fim do Modal --> 
   </body>
   </html>
