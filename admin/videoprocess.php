<?php
include("../conexao.php");

if (isset($_POST['enviar'])) {

  $materia = $_POST['materia'];
  $nomev = $_POST['nomev'];
  $descricao = $_POST['descricao'];

  $sql = "SELECT id from materia WHERE nome = '$materia'";
  $result = mysqli_query($conexao, $sql);
  while ($row = $result->fetch_assoc()) {
    $id_materia = $row['id'];
  }
  $link = $_POST['link'];
  $linkcerto = explode("=", $link);
  $savelink = $linkcerto[1];

  $sql = "INSERT INTO videos(nome_video, id_materia, descricao, link) VALUES('$nomev','$id_materia','$descricao','$savelink')";
  if (mysqli_query($conexao, $sql)) {
    session_start();
    $_SESSION['VideoEnviado'] = true;
    header("Location:addvideo.php");
  }
}
