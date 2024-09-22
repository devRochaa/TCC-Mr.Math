<?php
include("../conexao.php");

$nome = ucfirst($_GET["nome"]);
$sobrenome = ucfirst($_GET["sobrenome"]);
$email = $_GET["email"];
$senha = md5($_GET["senha"]);

$sqlVerificaRepetido = "SELECT id FROM usuarios WHERE email ='$email'";
$result = mysqli_query($conexao, $sqlVerificaRepetido);
if ($result->num_rows > 0) {
  echo "<style> #carregando {display: none;}</style>
    <div class='alert alert-danger' role='alert'>Já existe um cadastro com esse e-mail ($email)</div>
    <br>
    <a class='btn btn-primary' href='cadastro.html' role='button'>Voltar</a> ";
} else {

  $hash = sprintf('%07X', mt_rand(0, 0xFFFFFFF));

  $sql = "INSERT INTO usuarios(nome, sobrenome, email, senha, data_cadastro, hash) 
    VALUES ('$nome', '$sobrenome', '$email', '$senha', now(), '$hash');";
  if ($result = mysqli_query($conexao, $sql)) {


    $sql = "SELECT id from usuarios WHERE nome = '$nome'";
    $result = mysqli_query($conexao, $sql);

    // Saída de dados de cada linha
    while ($row = $result->fetch_assoc()) {
      $id = $row["id"];
    }

    $sql = "INSERT INTO desempenho(aulas_assistidas, ex_feitos, acertos, id_usuarios) 
      VALUES (0, 0, 0, $id);";
    $result = mysqli_query($conexao, $sql);
    include("envia_email.php");
  } else {
    echo   "<div class='alert alert-danger' role='alert'>Erro ao cadastrar usuário: <br>" . mysqli_connect_error($conexao) . "</div>";
  }
}



mysqli_close($conexao);
