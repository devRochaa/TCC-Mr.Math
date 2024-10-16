<?php
include("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Captura os dados enviados via AJAX
  $score = $_POST['score'];
  $ex_feitos = $_POST['ex_feitos'];
  $email = $_POST['email'];
  $sql = "SELECT id from usuarios where email = '$email'";
  if ($result = mysqli_query($conexao, $sql)) {
    while ($row = $result->fetch_assoc()) {
      $id = $row['id'];
    }

    $sql = "SELECT acertos from desempenho where id = $id";
    if ($result = mysqli_query($conexao, $sql)) {
      while ($row = $result->fetch_assoc()) {
        $acertos = $row['acertos'];
      }
    }


    $sql = "SELECT ex_feitos from desempenho where id_usuarios = $id";
    if ($result = mysqli_query($conexao, $sql)) {
      while ($row = $result->fetch_assoc()) {
        $bd_feitos = $row['ex_feitos'];
      }
    }
    $upd_feitos = $bd_feitos + $ex_feitos;
    $upd_acertos = $acertos + $score;
    // Preparar e executar a atualização
    $sql = "UPDATE desempenho SET acertos = ?, ex_feitos = ? WHERE id_usuarios = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("iis", $upd_acertos, $upd_feitos, $id);

    if ($stmt->execute()) {
      echo "";
    } else {
      echo "Erro ao atualizar usuário: " . $stmt->error;
    }
  }
  // Fecha a conexão
  $stmt->close();
  $conexao->close();
}
