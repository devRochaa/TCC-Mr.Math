<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exercícios</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .question {
      margin-bottom: 20px;
    }

    .options label {
      display: block;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  include("../conexao.php");
  if (!isset($_SESSION["usuario"]) ==  true) {
    unset($_SESSION["usuario"]);
    header("../login/inicio.html");
  }

  $logado = $_SESSION["usuario"];

  $sql = "SELECT nome FROM usuarios WHERE email = '$logado'";
  $con = mysqli_query($conexao, $sql);
  if ($con->num_rows > 0) {
    // Saída de dados de cada linha
    while ($row = $con->fetch_assoc()) {
      $nome = $row["nome"];
    }
  }
  $_SESSION['nome'] = $nome;
  echo $nome;
  mysqli_close($conexao);
  ?>


  <div id="questionContainer">
    <form method="post" action="process_answers.php">
      <div class="question">
        <h2>1. Qual é a capital do Brasil?</h2>
        <div class="options">
          <label><input type="radio" name="q1" value="a"> a) Rio de Janeiro</label>
          <label><input type="radio" name="q1" value="b"> b) São Paulo</label>
          <label><input type="radio" name="q1" value="c"> c) Brasília</label>
          <label><input type="radio" name="q1" value="d"> d) Belo Horizonte</label>
        </div>
      </div>
      <div class="question">
        <h2>1. Qual é a capital do eua?</h2>
        <div class="options">
          <label><input type="radio" name="q2" value="a"> a) Rio de Janeiro</label>
          <label><input type="radio" name="q2" value="b"> b) São Paulo</label>
          <label><input type="radio" name="q2" value="c"> c) Brasília</label>
          <label><input type="radio" name="q2" value="d"> d) Belo Horizonte</label>
        </div>
      </div>
      <div class="question">
        <h2>1. Qual é a capital do Brasil?</h2>
        <div class="options">
          <label><input type="radio" name="q3" value="a"> a) Rio de Janeiro</label>
          <label><input type="radio" name="q3" value="b"> b) São Paulo</label>
          <label><input type="radio" name="q3" value="c"> c) Brasília</label>
          <label><input type="radio" name="q3" value="d"> d) Belo Horizonte</label>
        </div>
      </div>
      <!-- Adicione mais perguntas aqui -->

      <button type="submit">Enviar Respostas</button>
    </form>
  </div>

</body>

</html>