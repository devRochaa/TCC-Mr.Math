<?php
ob_start();
session_start();
include("../conexao.php");

if (!isset($_SESSION["usuario"]) ==  true) {
    unset($_SESSION["usuario"]);
    header("../login/inicio.html");
}

$logado = $_SESSION["usuario"];
$nome = $_SESSION['nome'];
echo "Olá " . $nome . "<br>";

$sql = "SELECT id from usuarios WHERE nome = '$nome';";
$result = mysqli_query($conexao, $sql);
if ($result->num_rows > 0) {
    // Saída de dados de cada linha
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
    }
}


$correctAnswers = array(
    'q1' => 'c',
    'q2' => 'd',
    'q3' => 'a',

);


$score = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($correctAnswers as $question => $correctAnswer) {
        if (isset($_POST[$question]) && $_POST[$question] === $correctAnswer) {
            $score++;
        }
    }
}


$quant = count($correctAnswers);

echo "Você acertou " . $score . " de " . count($correctAnswers) . " perguntas.";
$sql = "UPDATE desempenho set acertos= acertos + $score WHERE id_usuarios=$id;";
$sql1 = "UPDATE desempenho set ex_feitos= ex_feitos + $quant WHERE id_usuarios=$id;";
$result1 = mysqli_query($conexao, $sql1);
if (mysqli_query($conexao, $sql)) {
    echo "resposta logada";
} else {
    echo "Erro" . mysqli_connect_error($conexao);
}
mysqli_close($conexao);
