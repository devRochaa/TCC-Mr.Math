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
        <div id="process_login">
        <form onsubmit="return false;" id="formulario">
          <div class="textfield">
            <label for="usuario">E-mail</label>
            <input type="text" name="email" id="email" placeholder="Seu e-mail ">
          </div>
          <div class="textfield">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="senha">
          </div>
          <button type="submit" class="btn-login" id="entrar">LOGIN</button>
        </form>
        <div id='div_process_login'></div>
        </div>
        <a href="../cadastro/cadastro.html" style="color: aliceblue;">Não tenho conta</a>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
    <script type="text/javascript">
    
    $("#entrar").click(function(){

      // Verificar se todos os campos do formulário foram preenchidos
      if ($("#email").val().length == 0 && $("#senha").val().length == 0) {
        swal("Não foi possível conectar!", "Preencha todos os campos", "error");
        return false;
      }
        var email = $("#email").val();
        var senha = $("#senha").val();
        
        // Carrega a página process_login.php para dentro da div processa_formulario (sem dar refresh na página)
        $.post('process_login.php?email=' + email + '&senha=' + senha, function(include_process_login){
          $("#div_process_login").html(include_process_login);
        });
    });

</script>

</body>
</html>

