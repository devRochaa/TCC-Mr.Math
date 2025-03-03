<?php
include("../conexao.php");

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  $sql = "SELECT nome, sobrenome, email, telefone, bio, rm FROM usuarios WHERE id = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    echo json_encode($usuario);
  } else {
    echo json_encode(["error" => "Usuário não encontrado."]);
  }
}
?>
