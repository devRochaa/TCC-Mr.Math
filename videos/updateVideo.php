<?php
include("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Captura os dados enviados via AJAX
  $email = $_POST['email'];

  $sql = "SELECT id from usuarios where email = '$email'";
  if ($result = mysqli_query($conexao, $sql)) {
    while ($row = $result->fetch_assoc()) {
      $id = $row['id'];
    }

    $sql = "SELECT aulas_assistidas from desempenho where id_usuarios = '$id'";
    if ($result = mysqli_query($conexao, $sql)) {
      while ($row = $result->fetch_assoc()) {
        $aulas_assistidas = $row['aulas_assistidas'];
      }
    }
    $aulas_assistidas = $aulas_assistidas + 1;
    // Preparar e executar a atualização
    $sql = "UPDATE desempenho SET aulas_assistidas = $aulas_assistidas WHERE id_usuarios = $id";
    if ($result = mysqli_query($conexao, $sql)) {
    } else {
    }
  }
  // Fecha a conexão

  $conexao->close();
}
