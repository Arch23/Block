<?php
    include("UserDAO.php");    
    $obj= new UserDAO("localhost","root","","roomz");
    if($obj->conn->connect_error){
        header("Cadastrar.html");
    }
    
    $COD_USUARIO=$_POST['Codigo'];
    $NOME_USUARIO=$_POST['Nome'];
    $EMAIL_USUARIO=$_POST['Email'];
    $SIGLA_DEPARTAMENTO=$_POST['Departamento'];
    $TIPO_USUARIO=$_POST['Tipo'];
    $KEY_USER=$_POST['Key'];
    $USUARIO_SENHA=$_POST['Senha'];
    
    if($obj->insereUsuario($COD_USUARIO, $NOME_USUARIO, $EMAIL_USUARIO, $SIGLA_DEPARTAMENTO,
           $TIPO_USUARIO, $KEY_USER, $USUARIO_SENHA)==1){
         echo "<script type=\"text/javascript\">alert('Usuário Criado com sucesso!');location.href='Cadastrar.html';</script>";
    }
    else if($obj->insereUsuario($COD_USUARIO, $NOME_USUARIO, $EMAIL_USUARIO, $SIGLA_DEPARTAMENTO,
           $TIPO_USUARIO, $KEY_USER, $USUARIO_SENHA)==2){
           echo "<script type=\"text/javascript\">alert('Usuário já cadastrado!');location.href='Cadastrar.html';</script>";
           exit();
     }
           else{
                echo "<script type=\"text/javascript\">alert('Erro ao criar usuário!');location.href='Cadastrar.html';</script>";
            }
   
?>