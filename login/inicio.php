<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/login.css?=<?php echo time();?>">
  <title>Login</title>
</head>

<body>
  <div class="main-login">
    <div class="left-login">
      <h1 class="poppins-bold"> FAÇA SEU LOGIN<h1 class="poppins-boldd">NA SUA CONTA</h1></h1><br><h2 class="mrmath">MR-MATH</h2>
      <img src="../img/calcanimation.svg" class="left-login-image" alt="calculadora animação">
    </div>
    <div class="right-login">
      <div class="card-login">
        <h1>LOGIN</h1>
        <form action="login.php" method="POST">
          <div class="textfield">
            <label for="usuario">E-mail</label>
            <input type="text" name="email" placeholder="Seu e-mail ">
          </div>
          <div class="textfield">
            <label for="senha">Senha</label>
            <input type="password" name="senha" placeholder="senha">
          </div>
          <button class="btn-login">LOGIN</button>
        </form>
        <a href="../cadastro/cadastro.html" style="color: aliceblue;">Não tenho conta</a>
      </div>
    </div>
  </div>
</body>

</html>