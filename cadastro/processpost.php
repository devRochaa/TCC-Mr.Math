<?php
session_start();
include("../conexao.php");

$hash = $_SESSION['hash'];
if (isset($_POST)) {
  $codigo = $_POST['codigo'];

  if ($hash == $codigo) {
    header("location: ativacao.php?hash=$hash");
  }
}
