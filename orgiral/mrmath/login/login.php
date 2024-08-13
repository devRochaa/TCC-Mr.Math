<?php
include("../conexao.php");

$email = $_POST["email"];
$senha = md5($_POST["senha"]);


$sql = "SELECT nome from usuarios where email='$email' and senha='$senha'";
$resultado = mysqli_query($conexao, $sql);
$linhas = mysqli_affected_rows($conexao);

if ($linhas > 0) {
  session_start();
  $_SESSION['usuario'] = $email;
  header("location: ../Exercicios/exercicio.php");
} else {
  echo "Dados incorretos!";
}
