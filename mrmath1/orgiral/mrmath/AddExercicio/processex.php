<?php
include("../conexao.php");

function getLetter($index)
{
  // Converte um índice numérico para a letra correspondente do alfabeto (A, B, C, ...)
  $charCode = ord('A') + $index;
  return chr($charCode);
}

$instituto = $_POST["instituto"];
$materia = $_POST["materia"];
$enunciado = $_POST["enunciado"];
$number = $_POST["number"];
$alternativas = array();
for ($i = 0; $i < $number; $i++) {
  $letra = getLetter($i);
  if (isset($_POST[$letra])) {
    $alternativas[$i] = $_POST["$letra"];
    echo $alternativas[$i] . "<br>";
  } else {
    echo "Chave $letra não encontrada no POST.<br>";
  }
}
$resposta = $_POST["resposta"];
$imagem = $_FILES["imagem"];

// Verifica se o upload foi bem-sucedido
if ($imagem['error'] === UPLOAD_ERR_OK) {
  $nomeImagem = $imagem['name'];
  $tipoImagem = $imagem['type'];
  $caminhoTemporario = $imagem['tmp_name'];

  // Verifica se o arquivo é uma imagem
  $info = getimagesize($caminhoTemporario);
  if ($info === FALSE) {
    die("Não é uma imagem válida.");
  }

  // Lê o conteúdo do arquivo e codifica em base64
  $conteudoImagem = file_get_contents($caminhoTemporario);
  $conteudoBase64 = base64_encode($conteudoImagem);

  // Prepara a consulta SQL
  $sql = ("INSERT INTO imagens (nome, dados_base64) VALUES ('$nomeImagem', '$conteudoBase64')");

  if ($result = mysqli_query($conexao, $sql)) {

    $sql = "SELECT id, nome FROM materia WHERE nome='$materia'";
    $result = mysqli_query($conexao, $sql);
    if ($result->num_rows > 0) {
      // Saída de dados de cada linha
      while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $code = substr($row['nome'], 0, 3) . $id;
      }
    }

    $sql = "SELECT id FROM imagens WHERE nome= '$nomeImagem'";
    $result = mysqli_query($conexao, $sql);
    if ($result->num_rows > 0) {
      // Saída de dados de cada linha
      while ($row = $result->fetch_assoc()) {
        $id_imagem = $row["id"];
      }
    }

    $sql = "INSERT INTO exercicios (id_materia, codigo_ex, enunciado, id_imagem) VALUES ($id,'$code','$enunciado',$id_imagem)";
    $result = mysqli_query($conexao, $sql);
    $sql = "SELECT id from exercicios where id_materia = $id";
    $result = mysqli_query($conexao, $sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $id_questao = $row["id"];
      }
    }

    for ($i = 0; $i < $number; $i++) {

      $chave = getLetter($i);
      echo $chave . " ";
      if ($chave == $resposta) {
        $esta_correto = 'sim';
        echo $esta_correto . '<br>';
      } else {
        $esta_correto = 'nao';
        echo $esta_correto . '<br>';
      }
      $sql = "INSERT INTO alternativas (esta_correto, conteudo, id_questao) VALUES ('$esta_correto','$alternativas[$i]',$id_questao)";
      $result = mysqli_query($conexao, $sql);
    }
    echo "Upload e salvamento foram feitos com sucesso!";
  } else {
    echo "Erro ao salvar no banco de dados: " . $conexao->error;
  }


  // Fecha a declaração
  $conexao->close();
} else {
  echo "Erro no upload do arquivo.";
}



// Fecha a conexão
