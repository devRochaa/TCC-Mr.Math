<?php
session_start();
$email = $_SESSION['usuario'];
include("../conexao.php");

if (isset($_POST)) {
  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];
  $telefone = $_POST['telefone'];
  $bio = $_POST['bio'];


  if ($telefone != '') {
    if (preg_match("/\(?\d{2}\)?\s?\d{5}\-?\d{4}/", $telefone)) {
      $sql = "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', telefone = '$telefone', bio = '$bio' where email='$email'";
      if (mysqli_query($conexao, $sql)) {
        header("location:../profile.php");
      }
    } else {
      $_SESSION['aviso_telefone'] = 'Telefone inválido';
      header("location:../profile.php");
      echo $_POST['telefone'];
    }
  } else {
    $sql = "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', telefone = '',bio = '$bio' where email='$email'";
    if (mysqli_query($conexao, $sql)) {
      header("location:../profile.php");
    }
  }
} else {
  echo "nao foi";
}
