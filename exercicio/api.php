<?php
include("../conexao.php");

// Query para selecionar questões e suas alternativas (tanto corretas quanto erradas)
$sql = "SELECT 
            e.id AS id_questao, 
            e.enunciado AS questao, 
            a.conteudo AS alternativa, 
            a.esta_correto AS correto 
        FROM alternativas a 
        LEFT JOIN exercicios e ON a.id_questao = e.id 
        ORDER BY e.id, a.esta_correto DESC"; // Ordena por id da questão e dá prioridade para a alternativa correta

$result = mysqli_query($conexao, $sql);

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
                "alternativasErradas" => $current_alternativas['alternativasErradas'],
                "alternativaCorreta" => $current_alternativas['alternativaCorreta']
            ];
        }
        // Reseta para a nova questão
        $current_questao = [
            "id_questao" => $row['id_questao'],
            "questao" => $row['questao']
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
        "alternativasErradas" => $current_alternativas['alternativasErradas'],
        "alternativaCorreta" => $current_alternativas['alternativaCorreta']
    ];
}

// Convertendo o array para JSON
$json = json_encode($quiz, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// Exibindo o JSON gerado
echo $json;

?>
