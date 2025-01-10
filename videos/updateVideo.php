<?php
include("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $assistido = intval($_POST['assistido']); // Recebe 1 para adicionar ou -1 para remover

  // Obtém o ID do usuário com base no e-mail
  $sql = "SELECT id FROM usuarios WHERE email = '$email'";
  $result = mysqli_query($conexao, $sql);

  if ($result && $row = $result->fetch_assoc()) {
    $id = $row['id'];

    // Atualiza a tabela desempenho
    $sql = "UPDATE desempenho SET aulas_assistidas = GREATEST(0, aulas_assistidas + $assistido) WHERE id_usuarios = $id";
    if (mysqli_query($conexao, $sql)) {
      echo "Atualização realizada com sucesso.";
    } else {
      echo "Erro ao atualizar desempenho: " . mysqli_error($conexao);
    }
  } else {
    echo "Usuário não encontrado.";
  }

  // Fecha a conexão
  $conexao->close();
}
