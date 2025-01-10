<?php

if (!isset($_GET["email"]) && !isset($_GET["senha"])) {
  echo "<script>swal('Falha ao se conectar!', 'E-mail e senha incorretos', 'error');</script>";
  die();
}
$email = $_GET["email"];
$senha = md5($_GET["senha"]);

include("../conexao.php");

$sql = "SELECT nome, status from usuarios where email='$email' and senha='" . md5($_GET["senha"]) . "';";
$resultado = mysqli_query($conexao, $sql);
$linhas = mysqli_affected_rows($conexao);

if ($linhas <= 0) {
  echo "<script>swal('Falha ao se conectar!', 'E-mail ou senha incorretos', 'error');</script>";
}
if ($linhas > 0) {
  $row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
  if ($row['status'] == 1) {
    echo "<script>swal('Seu e-mail ainda não foi verificado!', 'Confira sua caixa de e-mail', 'error');</script>";
  } else if ($row['status'] == 2) {


    session_start();
    $_SESSION['usuario'] = $email;
    $_SESSION['nome'] = ucfirst($row['nome']);
    echo "<script> window.location.href='../menu.php' </script>";
  }
} else {
  echo ('<script>console.log("Nenhum registro encontrado")</script>');
}
