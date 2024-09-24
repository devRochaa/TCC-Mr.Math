<?php
include("../conexao.php");

// Captura os dados do formulário
$instituto = $_POST["instituto"];
$materia = $_POST["materia"];
$enunciado = $_POST["enunciado"];
$resposta = $_POST["resposta"];

// Verifica se a imagem foi enviada
$imagem = isset($_FILES["imagem"]) ? $_FILES["imagem"] : null;

$id_imagem = null; // Inicializa como nulo

// Se a imagem foi enviada, processe-a
if ($imagem && $imagem['error'] === UPLOAD_ERR_OK) {
  $nomeImagem = $imagem['name'];
  $caminhoTemporario = $imagem['tmp_name'];

  // Verifica se o arquivo é uma imagem
  $info = getimagesize($caminhoTemporario);
  if ($info === FALSE) {
    die("Não é uma imagem válida.");
  }

  // Lê o conteúdo do arquivo e codifica em base64
  $conteudoImagem = file_get_contents($caminhoTemporario);
  $conteudoBase64 = base64_encode($conteudoImagem);

  // Prepara a consulta SQL para inserir a imagem
  $sql = "INSERT INTO imagens (nome, dados_base64) VALUES ('$nomeImagem', '$conteudoBase64')";
  if (mysqli_query($conexao, $sql)) {
    echo "imagem salva "; // Para a execução em caso de erro
  } else {
    echo "Erro ao salvar a imagem no banco de dados: " . $conexao->error;
    exit;
  }

  // Obtém o ID da imagem inserida
  $id_imagem = mysqli_insert_id($conexao); // Captura o ID da última imagem inserida
}

// Obtém o ID da matéria
$sql = "SELECT id FROM materia WHERE nome='$materia'";
$result = mysqli_query($conexao, $sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $id = $row["id"];
}

// Cria o código baseado na matéria
$code = "MAT" . $id; // Ajuste conforme necessário

// Cria uma lista para as alternativas
$alternativas = [];
$letras = ['A', 'B', 'C', 'D', 'E'];

foreach ($letras as $letra) {
  if (isset($_POST[$letra])) {
    $alternativas[$letra] = $_POST[$letra];
  }
}

if (isset($id_imagem)) {

  $sql = "INSERT INTO exercicios (id_materia, codigo_ex, enunciado, id_imagem) VALUES ($id, '$code', '$enunciado', $id_imagem)";
} else {

  $sql = "INSERT INTO exercicios (id_materia, codigo_ex, enunciado, id_imagem) VALUES ($id, '$code', '$enunciado', null)";
}
// Insere o exercício no banco de dados
if (mysqli_query($conexao, $sql)) {
  echo "Upload e salvamento foram feitos com sucesso!";
} else {
  echo "Erro ao salvar no banco de dados: " . $conexao->error;
}

// Fecha a conexão
$conexao->close();
