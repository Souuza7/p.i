<?php
// Defina suas variáveis de conexão com o banco de dados
$host = "localhost"; // ou o endereço IP do servidor MySQL
$usuario = "root"; // seu usuário do MySQL
$senha = ""; // sua senha do MySQL
$dbname = "restaurante"; // o nome do banco de dados

// Criando a conexão com o MySQL
$conn = mysqli_connect($host, $usuario, $senha, $dbname);

// Verifique se a conexão foi bem-sucedida
if (!$conn) {
    die("Erro de conexão com o MySQL: " . mysqli_connect_error());
}
?>
