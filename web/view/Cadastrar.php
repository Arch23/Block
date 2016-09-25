<!DOCTYPE html>
<html lang="en">
<head>
   <title>Cadastro</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/common.css">
   <link rel="stylesheet" type="text/css" href="./css/Cadastrar.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script>
  function gotoCadastro(){
    $(document).ready(function(){
          $.post("../controller/CadastroController.php",
           {
              Codigo: $("#Codigo").val(),
              Nome:   $("#Nome").val(),
              Email:  $("#Email").val(),
              Departamento: $("#Departamento").val(),
              Tipo:   $("#Tipo").val(),
              Key:    $("#Key").val(),
              Senha:  $("#Senha").val()
          },
          function(data,status){
            if(data.search("criado")>=0){
              alert("Usuário Já Existente!");
            }
            else if(data.search("sucesso")>=0){
              alert("Usuário Criado com Suceso!");
              location.href="../index.php";
            }else{
              alert("Erro ao criar usuário verifique seus dados e tente novamente!");
            }
           });

    });
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
                  <select>
                     <option value="volvo">Volvo</option>
                     <option value="saab">Saab</option>
                     <option value="mercedes">Mercedes</option>
                     <option value="audi">Audi</option>
                  </select>
               </div>
               
               <div class="form-group">
                  <label for="Tipo" class="col-sm-2 control-label">Tipo</label>
                  <select>
                     <option value="volvo">Volvo</option>
                     <option value="saab">Saab</option>
                     <option value="mercedes">Mercedes</option>
                     <option value="audi">Audi</option>
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

   </body>
   </html>
