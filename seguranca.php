<?php
session_start();
include("conexao.php");
if (!isset($_SESSION["nome"])) {
  header("Location:../login/inicio.php");
  exit();
} else {
  $nome = $_SESSION["nome"];
}
