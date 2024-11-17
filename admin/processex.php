<?php
include("../conexao.php");

// Captura os dados do formulário
$instituto = $_POST["instituto"];
$materia = $_POST["materia"];
$enunciado = $_POST["enunciado"];
$resposta = $_POST["resposta"];
$correcaolink = $_POST["correcao"]; // Link da correção (input correcao)

// Função para processar as imagens
function processarImagem($imagem)
{
  if ($imagem && $imagem['error'] === UPLOAD_ERR_OK) {
    $nomeImagem = $imagem['name'];
    $caminhoTemporario = $imagem['tmp_name'];

    // Verifica se o arquivo é uma imagem
    $info = getimagesize($caminhoTemporario);
    if ($info === FALSE) {
      return false; // Não é uma imagem válida
    }

    // Lê o conteúdo do arquivo e codifica em base64
    $conteudoImagem = file_get_contents($caminhoTemporario);
    $conteudoBase64 = base64_encode($conteudoImagem);

    // Retorna os dados da imagem
    return [
      'nome' => $nomeImagem,
      'conteudoBase64' => $conteudoBase64,
      'tipo' => $info['mime'] // Tipo da imagem (ex: image/jpeg, image/png)
    ];
  } else {
    return false; // Erro no upload da imagem
  }
}

// Verifica e processa a imagem do enunciado
$imagem = isset($_FILES["imagem"]) ? $_FILES["imagem"] : null;
$id_imagem = null; // Inicializa como nulo
if ($imagem) {
  $dadosImagem = processarImagem($imagem);
  if ($dadosImagem) {
    $sql = "INSERT INTO imagens (nome, dados_base64) VALUES ('{$dadosImagem['nome']}', '{$dadosImagem['conteudoBase64']}')";
    if (mysqli_query($conexao, $sql)) {
      $id_imagem = mysqli_insert_id($conexao); // Obtém o ID da imagem do enunciado
    } else {
      echo "Erro ao salvar a imagem do enunciado: " . $conexao->error;
      exit;
    }
  }
}

// Verifica e processa a imagem de correção (imagem2)
$imagem2 = isset($_FILES["imagem2"]) ? $_FILES["imagem2"] : null;
$id_correcao = null; // Inicializa como nulo
if ($imagem2) {
  $dadosImagem2 = processarImagem($imagem2);
  if ($dadosImagem2) {
    $sql = "INSERT INTO imagens (nome, dados_base64) VALUES ('{$dadosImagem2['nome']}', '{$dadosImagem2['conteudoBase64']}')";
    if (mysqli_query($conexao, $sql)) {
      $id_correcao = mysqli_insert_id($conexao); // Obtém o ID da imagem de correção
    } else {
      echo "Erro ao salvar a imagem de correção: " . $conexao->error;
      exit;
    }
  }
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
$letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];

foreach ($letras as $letra) {
  if (isset($_POST[$letra])) {
    $alternativas[$letra] = $_POST[$letra];
  }
}

// Prepara a inserção do exercício com a correção associada (id_correcao e id_imagem)
$sql = "INSERT INTO exercicios (id_materia, codigo_ex, enunciado, id_imagem, correcao_link) 
        VALUES ($id, '$code', '$enunciado', " . ($id_imagem ? $id_imagem : 'NULL') . ", '$correcaolink')";

// Insere o exercício no banco de dados
if (mysqli_query($conexao, $sql)) {
  $id_questao = mysqli_insert_id($conexao); // Supondo que você já tenha inserido a questão e obtido o ID

  // Agora insira as alternativas com o id_correcao (se houver)
  foreach ($alternativas as $letra => $texto) {
    $esta_correto = ($letra === $_POST['resposta']) ? 'sim' : 'não'; // Verifica se é a alternativa correta
    $sql_alt = "INSERT INTO alternativas (conteudo, esta_correto, id_questao, id_correcao) 
                    VALUES ('$texto', '$esta_correto', $id_questao, " . ($id_correcao ? $id_correcao : 'NULL') . ")";

    if (!mysqli_query($conexao, $sql_alt)) {
      echo "Erro ao salvar a alternativa $letra: " . mysqli_error($conexao);
    }
  }

  echo "Upload e salvamento foram feitos com sucesso!";
} else {
  echo "Erro ao salvar no banco de dados: " . $conexao->error;
}

// Fecha a conexão
$conexao->close();
