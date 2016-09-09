<?php

// Verifica se houve POST e se o codigo ou senha estão vazios
if (!empty($_POST) AND (empty($_POST['Codigo']) OR empty($_POST['Senha']))) {
    header("Location: loginbd.php"); exit;
}

// Tenta se conectar ao servidor MySQL
$con = mysql_connect('localhost', 'root', '');
// Tenta se conectar a um banco de dados MySQL
$db = mysql_select_db('mydb', $db) ;

if(!$con){
    die("Não houve conexão com o banco de dados." . mysql_error());
}
//passa os valores para novas variaveis
$codigo = mysql_real_escape_string($_POST['Codigo']);
$senha = mysql_real_escape_string($_POST['Senha']);

// Validação do usuário/senha digitados
$sql = "SELECT `COD_USUARIO` FROM `USUARIO` WHERE (`COD_USUARIO` = '".$codigo ."') ";
$query = mysql_query($sql);
if (mysql_num_rows($query) != 1) {
    // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
    echo "Login inválido!"; exit;
} else {
    // Salva os dados encontados na variável $resultado
    $resultado = mysql_fetch_assoc($query);
}


?>
