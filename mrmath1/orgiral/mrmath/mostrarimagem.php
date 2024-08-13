<?php
include "conexao.php";
// Verifica a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
// Consulta todas as imagens
$sql = "SELECT id, nome, dados_base64 FROM imagens";
$result = $conexao->query($sql);

$imagens = [];
if ($result->num_rows > 0) {
    // Armazena todas as imagens em um array
    while ($row = $result->fetch_assoc()) {
        $imagens[] = [
            'nome' => $row['nome'],
            'dados_base64' => $row['dados_base64']
        ];

        $id_image = $row['id'];
        $sql = "SELECT id, enunciado, codigo_ex from exercicios where id_imagem = $id_image";
        $resultE = mysqli_query($conexao, $sql);

        while ($row = $resultE->fetch_assoc()) {
            $exercicio[] = [
                'id' => $row['id'],
                'enunciado' => $row['enunciado'],
                'code' => $row['codigo_ex']
            ];
            $id_questao = $row['id'];
            $sql = "SELECT conteudo, esta_correto, id_questao from alternativas where id_questao = $id_questao";
            $resultA = mysqli_query($conexao, $sql);
            while ($row = $resultA->fetch_assoc()) {
                $alternativas[] = [
                    'conteudo' => $row['conteudo'],
                    'esta_correto' => $row['esta_correto'],
                    'id_questao' => $row['id_questao']
                ];
            }
        }
    }
} else {
    echo "Nenhuma imagem encontrada.";
    exit;
}

// Fecha a conexão

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibição de Imagens</title>
    <style>
        #imagem {
            max-width: 500px;
            height: auto;
        }
    </style>
</head>

<body>
    <h1>Exercicios:</h1>

    <?php if (!empty($imagens) && !empty($exercicio) && !empty($alternativas)) : ?>
        <h2 id="code"><?php echo htmlspecialChars($exercicio[0]['code']); ?></h2>
        <h2 id="Enunciado"><?php echo htmlspecialChars($exercicio[0]['enunciado']); ?></h2>
        <img id="imagem" src="data:image/jpeg;base64,<?php echo $imagens[0]['dados_base64']; ?>" alt="Imagem recuperada">
        <br>
        <form>
            <?php
            $sql = "SELECT id_questao from alternativas where id_questao = id_questao";
            $result = mysqli_query($conexao, $sql);
            while ($row = $result->fetch_assoc()) {
                echo $row['id_questao'] . " ";
            }
            for ($i = 0; $i < count($alternativas); $i++) {
                echo "<label class='container'>" . $alternativas[$i]['conteudo'] .
                    "<input type='radio' checked='checked' name='radio'>
                <span class='checkmark'></span>
              </label> <br>";
            }
            ?>
        </form>
        <button onclick="anterior()">Anterior</button>
        <button onclick="proxima()">Próxima</button>
    <?php endif; ?>
    <a href="imagem.php"><button>voltar</button></a>
    <script>
        var code = <?php echo json_encode($exercicio); ?>;
        var exercicio = <?php echo json_encode($exercicio); ?>;
        var imagens = <?php echo json_encode($imagens); ?>;
        var indiceAtual = 0;

        function mostrarImagem(indice) {
            document.getElementById('code').innerText = exercicio[indice].code;
            document.getElementById('Enunciado').innerText = exercicio[indice].enunciado;
            document.getElementById('imagem').src = 'data:image/jpeg;base64,' + imagens[indice].dados_base64;
        }

        function anterior() {
            indiceAtual = (indiceAtual > 0) ? indiceAtual - 1 : imagens.length - 1;
            mostrarImagem(indiceAtual);
        }

        function proxima() {
            indiceAtual = (indiceAtual < imagens.length - 1) ? indiceAtual + 1 : 0;
            mostrarImagem(indiceAtual);
        }

        const questoes = [
            {id: 28, enunciado: "1+1?"},
            {id: 29, enunciado: "1+80?"},
        ]

        const alternativas =  [
            {id: 28, alternativa: "2"},
            {id: 28, alternativa: "3"},
        ]

        let questoesComAlternativas

        questoes.forEach(q => {
            let novaQuestao

            if(!questoesComAlternativas.includes(q)){
                novaQuestao = {
                    id: q.id,
                    enunciado: q.enunciado,
                    alternativas: []
                }
            } else return


            alternativas.forEach(a => {
                if (a.id == q.id) {
                    novaQuestao.alternativas.push(a.alternativa)
                }
            })


            questoesComAlternativas.push(novaQuestao)
        })


    </script>
</body>

</html>