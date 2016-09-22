<?php
    include("../model/UserDAO.php");    
    $obj= new UserDAO("localhost","root","","roomz");
    if($obj->conn->connect_error){
        //header("../view/Cadastrar.html");
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
         echo "sucesso";
        exit();
    }
    else if($obj->insereUsuario($COD_USUARIO, $NOME_USUARIO, $EMAIL_USUARIO, $SIGLA_DEPARTAMENTO,
      $TIPO_USUARIO, $KEY_USER, $USUARIO_SENHA)==2){
      echo "criado";
      exit();
     }
     else{
       echo "erro";
       exit();
    }
   
?>