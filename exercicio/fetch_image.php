<?php
header('Content-Type: application/json');
require_once '../conexao.php'; // Conexão com o banco

$id = $_POST['id'] ?? null;

if ($id) {
  $query = "SELECT dados_base64 AS imageBase64 FROM imagens WHERE id = ?";
  $stmt = $conexao->prepare($query);
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $data = $result->fetch_assoc();

  echo json_encode(['imageBase64' => $data['imageBase64'] ?? null]);
} else {
  echo json_encode(['error' => 'ID não fornecido']);
}
