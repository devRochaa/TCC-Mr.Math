<?php
session_start();
$id = $_SESSION['id'];
include("../conexao.php");
$sql = "DELETE FROM usuarios WHERE id = '$id'";
unset($_SESSION);
if ($result = mysqli_query($conexao, $sql)) {
  echo "<script> window.location.href='../cadastro/cadastro.html' </script>";
} else {
  echo "<script> window.location.href='../menu.php' </script>";
}
