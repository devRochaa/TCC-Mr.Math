<?php
session_start();
if (!isset($_SESSION["nome"])) {
  header("Location: ../index.html");
  exit();
} else {
  include("conexao.php");
  $nome = $_SESSION["nome"];
}
