<?php
include("../conexao.php");

// Recebe os dados do formulário
$nome_materia = $_POST["nome_materia"];
$descricao = $_POST['descricao'];

// Diretório para salvar as imagens
$diretorio = "../img/thumbs/";
if (!file_exists($diretorio)) {
  mkdir($diretorio, 0777, true); // Cria o diretório, se não existir
}

// Verifica se uma imagem foi enviada
if (isset($_FILES['foto_materia']) && $_FILES['foto_materia']['error'] === UPLOAD_ERR_OK) {
  $foto = $_FILES['foto_materia'];

  // Pega as informações do arquivo
  $nomeArquivo = basename($foto['name']);
  $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

  // Verifica se o arquivo é uma imagem válida (jpg, jpeg ou png)
  if (in_array($extensao, ['jpg', 'jpeg', 'png'])) {
    // Gera um nome único para evitar conflitos
    $nomeUnico = uniqid("materia_") . "." . $extensao;
    $caminhoCompleto = $diretorio . $nomeUnico;

    // Move o arquivo para o diretório
    if (move_uploaded_file($foto['tmp_name'], $caminhoCompleto)) {
      // Insere no banco de dados
      $sql = "INSERT INTO materia (nome, descricao, thumb) VALUES ('$nome_materia', '$descricao', '$caminhoCompleto')";
      if (mysqli_query($conexao, $sql)) {
        echo "Matéria e foto cadastrada com sucesso!<br>
                <a href='addmateria.php'><button>Voltar</button></a>";
      } else {
        echo "Erro ao salvar no banco de dados: " . mysqli_error($conexao);
      }
    } else {
      echo "Erro ao mover a imagem para o servidor.";
    }
  } else {
    echo "Formato de arquivo inválido. Apenas JPG, JPEG e PNG são permitidos.";
  }
} else {
  // Caso nenhuma imagem seja enviada, salva apenas os outros dados
  $sql = "INSERT INTO materia (nome, descricao) VALUES ('$nome_materia', '$descricao')";
  if (mysqli_query($conexao, $sql)) {
    echo "Matéria cadastrada com sucesso!<br>
        <a href='addmateria.php'><button>Voltar</button></a>";
  } else {
    echo "Erro ao salvar no banco de dados: " . mysqli_error($conexao);
  }
}
