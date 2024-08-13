<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "bd_mrmath";

$conexao = mysqli_connect($servidor, $usuario, $senha, $dbname); // estabelece a conexão com o banco
if (!$conexao) {
  die("Houve um erro: " . mysqli_connect_error());
}