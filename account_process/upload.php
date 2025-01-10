<?php
include("../conexao.php");
session_start();
if (isset($_POST['enviar'])) {
  // Formulário foi enviado!
  $arquivo = $_FILES['pfp'];

  $arquivoNovo = explode('.', $arquivo['name']);
  $extensao = $arquivoNovo[sizeof($arquivoNovo) - 1];
  $extensoesPermitidas = ['jpg', 'png'];

  if (!in_array($extensao, $extensoesPermitidas)) {
    die('Você não pode fazer upload deste tipo de arquivo');
  } else {
    move_uploaded_file($arquivo['tmp_name'], '../img/pfp/' . $arquivo['name']);
    $aqv = $arquivo['name'];
    $email = $_SESSION['usuario'];
    $sql = "UPDATE usuarios SET pfp = '$aqv' where email = '$email'";
    if (mysqli_query($conexao, $sql)) {
      header("location:../profile.php");
    }
  }
}
