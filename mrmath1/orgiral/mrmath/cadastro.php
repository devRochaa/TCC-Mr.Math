<?php
include("conexao.php");

$nome = $_POST["nome"];
$sobrenome = $_POST["sobrenome"];
$email = $_POST["email"];
$senha = md5($_POST["senha"]);

$sql = "INSERT INTO usuarios(nome, sobrenome, email, senha) 
    VALUES ('$nome', '$sobrenome', '$email', '$senha');";


if (mysqli_query($conexao, $sql)) {
  echo "Usuàrio cadastrado com sucesso";
  $sql = "SELECT id from usuarios WHERE nome = '$nome'";
  $result = mysqli_query($conexao, $sql);
  if ($result->num_rows > 0) {
    // Saída de dados de cada linha
    while ($row = $result->fetch_assoc()) {
      $id = $row["id"];
    }
  }
  $sql = "INSERT INTO desempenho(aulas_assistidas, ex_feitos, acertos, id_usuarios) 
    VALUES (0, 0, 0, $id);";
  $result = mysqli_query($conexao, $sql);
  header("location:login/inicio.php");
} else {
  echo "Erro" . mysqli_connect_error($conexao);
}


mysqli_close($conexao);
