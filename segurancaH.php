<?php
session_start();
if (!isset($_SESSION["usuario"])) {
  header("Location: index.html");
  exit();
} else {
  include("conexao.php");
}
