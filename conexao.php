<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "bd_mrmath";
$port = 3307;
$conexao = mysqli_connect($servidor, $usuario, $senha, $dbname, $port); // estabelece a conexão com o banco
if (!$conexao) {
  die("Houve um erro: " . mysqli_connect_error());
}