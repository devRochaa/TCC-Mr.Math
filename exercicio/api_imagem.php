<?php
header('Content-Type: application/json');
require_once '../conexao.php';  // Certifique-se de incluir o arquivo de conexão com o banco

$id_imagem = $_POST['id'] ?? null;  // Pega o ID enviado via POST

if ($id_imagem) {
  // Consulta no banco para buscar a imagem em base64
  $query = "SELECT dados_base64 AS imageBase64 FROM imagens WHERE id = ?";
  $stmt = $conexao->prepare($query);
  $stmt->bind_param('i', $id_imagem);
  $stmt->execute();
  $result = $stmt->get_result();
  $data = $result->fetch_assoc();

  // Retorna a imagem em base64 ou null caso não tenha encontrado
  echo json_encode(['imageBase64' => $data['imageBase64'] ?? null]);
} else {
  echo json_encode(['error' => 'ID da imagem não fornecido']);
}
