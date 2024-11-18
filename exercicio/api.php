<?php
include("../conexao.php");
session_start();
if (isset($_SESSION['id_materia'])) {
    $id_materia = $_SESSION['id_materia'];

    // Query para selecionar questões e suas alternativas (tanto corretas quanto erradas)
    $sql = "SELECT 
            e.id AS id_questao, 
            e.enunciado AS questao, 
            e.id_correcao, e.id_imagem, e.correcao_link,
            a.conteudo AS alternativa, 
            a.esta_correto AS correto 
        FROM alternativas a 
        LEFT JOIN exercicios e ON a.id_questao = e.id WHERE e.id_materia = $id_materia
        ORDER BY e.id, a.esta_correto DESC "; // Ordena por id da questão e dá prioridade para a alternativa correta

    $result = mysqli_query($conexao, $sql);
} else {
    header("location: selecionarEx.php");
}

$quiz = [];
$current_questao = null;
$current_alternativas = [
    "alternativasErradas" => [],
    "alternativaCorreta" => null
];

// Loop para processar as questões e suas alternativas
while ($row = mysqli_fetch_assoc($result)) {
    // Verifica se estamos em uma nova questão
    if ($current_questao === null || $current_questao['id_questao'] !== $row['id_questao']) {
        // Se não for a primeira questão, salva a anterior no quiz
        if ($current_questao !== null) {
            // Adiciona a questão ao quiz
            $quiz[] = [
                "questao" => $current_questao['questao'],
                "id_imagem" => $current_questao['id_imagem'],
                "id_correcao" => $current_questao['id_correcao'],
                "correcao_link" => $current_questao['correcao_link'],
                "alternativasErradas" => $current_alternativas['alternativasErradas'],
                "alternativaCorreta" => $current_alternativas['alternativaCorreta']
            ];
        }
        // Reseta para a nova questão
        $current_questao = [
            "id_questao" => $row['id_questao'],
            "questao" => $row['questao'],
            "id_imagem" => $row['id_imagem'],  // Adiciona id_imagem
            "id_correcao" => $row['id_correcao'],  // Adiciona id_correcao
            "correcao_link" => $row['correcao_link']  // Adiciona link (ou correcao_link)
        ];
        $current_alternativas = [
            "alternativasErradas" => [],
            "alternativaCorreta" => null
        ];
    }

    // Organiza as alternativas: considera "sim" como correto
    if ($row['correto'] === "sim") {
        $current_alternativas['alternativaCorreta'] = $row['alternativa'];
    } else {
        $current_alternativas['alternativasErradas'][] = $row['alternativa'];
    }
}

// Adiciona a última questão ao quiz
if ($current_questao !== null) {
    $quiz[] = [
        "questao" => $current_questao['questao'],
        "id_imagem" => $current_questao['id_imagem'],
        "id_correcao" => $current_questao['id_correcao'],
        "correcao_link" => $current_questao['correcao_link'],
        "alternativasErradas" => $current_alternativas['alternativasErradas'],
        "alternativaCorreta" => $current_alternativas['alternativaCorreta']
    ];
}

// Convertendo o array para JSON
$json = json_encode($quiz, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// Exibindo o JSON gerado
echo $json;
