<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/cadastro.css?=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Ativação</title>
</head>

<body>

  <div class="main-login">
    <div class="left-login">
      <h1 class="poppins-bold">FAÇA SEU CADASTRO</h1>
      <h1 class="poppins-boldd">ENTRE PARA O TIME</h1>
      <h2 class="mrmath">MR-MATH</h2>
      <img src="../img/calcanimation.svg" class="left-login-image" alt="calculadora animação">
    </div>

    <div class="right-login">
      <div style="margin-left:25vw;" class="card-login">
        <h1 id="h1">CADASTRO</h1>
        <?php
        if (isset($_GET['hash'])) {
          $hash = $_GET['hash'];

          // faz a conexão
          include("../conexao.php");

          // verifica se a hash resgatada na URL existe no banco de dados
          $sqlVerificaHash = "select hash from usuarios where hash='$hash'";

          if ($resultadoVerificaHash = mysqli_query($conexao, $sqlVerificaHash)) {
            $qtdLinhas = mysqli_num_rows($resultadoVerificaHash);

            if ($qtdLinhas > 0) {
              $sqlAlteraStatus = "UPDATE usuarios SET status='2', hash='', ativacao=now() WHERE hash='$hash'";

              if (mysqli_query($conexao, $sqlAlteraStatus)) {
                echo "<div class='alert alert-success role='alert'>
                Cadastro ativado com sucesso! <a href='../login/login.php'>Clique aqui</a> para fazer o login
                </div>";
              } else {
                echo "<div class='alert alert-danger role='alert'>
                Erro ao alterar o status: " . mysqli_error($conexao) . "
                </div>";
              }
            } else {
              echo "<div class='alert alert-danger role='alert'>
                Esse link de ativação é inválido.
            </div>
            <br>
            <a class='btn btn-primary' href='../index.html'>Voltar</a>";
            }
          }
        }
        ?>
        <div id='carregando' align="center"></div>
        <div id='processa_form'></div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>