<?php
include "conexao.php";

// Verifica a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

if (isset($_POST['acao'])) {
    if (isset($_FILES['file'])) {
        $arquivo = $_FILES['file'];

        // Verifica se o upload foi bem-sucedido
        if ($arquivo['error'] === UPLOAD_ERR_OK) {
            $nomeArquivo = $arquivo['name'];
            $tipoArquivo = $arquivo['type'];
            $caminhoTemporario = $arquivo['tmp_name'];

            // Verifica se o arquivo é uma imagem
            $info = getimagesize($caminhoTemporario);
            if ($info === FALSE) {
                die("Não é uma imagem válida.");
            }

            // Lê o conteúdo do arquivo e codifica em base64
            $conteudoArquivo = file_get_contents($caminhoTemporario);
            $conteudoBase64 = base64_encode($conteudoArquivo);

            // Prepara a consulta SQL
            $stmt = $conexao->prepare("INSERT INTO imagens (nome, dados_base64) VALUES (?, ?)");
            $stmt->bind_param("ss", $nomeArquivo, $conteudoBase64);

            // Executa a consulta
            if ($stmt->execute()) {
                echo "Upload e criptografia foram feitos com sucesso!";
            } else {
                echo "Erro ao salvar no banco de dados: " . $stmt->error;
            }

            // Fecha a declaração
            $stmt->close();
        } else {
            echo "Erro no upload do arquivo.";
        }
    }
}

// Fecha a conexão
$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload e Criptografia de Imagens</title>
</head>
<body>
    <h1>Upload e Criptografia de Imagens em Base64</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Escolha uma imagem para upload:</label><br>
        <input type="file" id="file" name="file" required><br><br>
        <button type="submit" name="acao">Enviar</button>
    </form>
    <a href="mostrarimagem.php"><button>colocar imagem</button></a>
</body>
</html>