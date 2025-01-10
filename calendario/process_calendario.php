<?php
include("../conexao.php");

if((!isset($_GET["data"])) && (!isset($_GET["titulo"]))){
    echo "<script> swal('Erro ao salvar!', 'A data e o titulo não foram encontrados', 'error'); </script>";
    die();
}
session_start();
$data = $_GET["data"];
$titulo = $_GET["titulo"];
$id_usuario = $_SESSION['id'];
echo $data;
$sql = "INSERT INTO calendario(id_usuario, titulo, data) 
    VALUES ($id_usuario, '$titulo', '$data');";
    $result = mysqli_query($conexao, $sql);
