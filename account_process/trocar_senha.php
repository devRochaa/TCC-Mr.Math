<?php
session_start();
$id = $_SESSION['id'];
include("../conexao.php");

$senha = $_GET["senha"];

$sql = "UPDATE usuarios set senha = '$senha' where id = '$id'";
if ($result = mysqli_query($conexao, $sql)) {
} else {
}
