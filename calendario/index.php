<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- arquivos style -->
  <link href="../css/calendario.css?=<?php echo time(); ?>" rel="stylesheet">
  <link href="../css/darkMode.css?=<?php echo time(); ?>" rel="stylesheet">
  <link href="../css/navbar.css?=<?php echo time(); ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <title>Calendário</title>
</head>
<!-- dark mode -->
<?php
include("../navbar.php");
include("../conexao.php");
?>
<div class="tela">

  <img src="../img/logo.png" alt="" class="logoIMG">

  <div class="toggleC">
    <div class="solua">
      <img src="../img/sol.png" alt="" class="sol">
      <img src="../img/lua.png" alt="" class="lua">
    </div>
    <input id="switch" type="checkbox" name="theme">
    <label class="lbl" for="switch">Toggle</label>
  </div>

  <!-- -------- -->

  <body>
    <div id="containerC">

      <h1 class="calem">CALENDARIO</h1>
      <div id="headerC">
        <div id="monthDisplay"></div>

        <div>
          <button class='botao' id="backButton">Voltar</button>
          <button class='botao' id="nextButton">Próximo</button>
        </div>

      </div>

      <div id="weekdays">
        <div>Domingo</div>
        <div>Segunda-feira</div>
        <div>Terça-feira</div>
        <div>Quarta-feira</div>
        <div>Quinta-feira</div>
        <div>Sexta-feira</div>
        <div>Sábado</div>
      </div>


      <!-- div dinamic -->
      <div id="calendar"></div>


    </div>

    <div id="newEventModal">
      <h2>Novo Evento</h2>

      <input type="text" name="Basica" id="eventTitleInput">
      <button class='botao' id="saveButton"> Salvar</button>
      <button class='botao' id="cancelButton">Cancelar</button>
    </div>

    <div id="deleteEventModal">
      <h2>Evento</h2>

      <div id="eventText"></div><br>


      <button class='botao' id="deleteButton">Deletar</button>
      <button class='botao' id="closeButton">Fechar</button>
    </div>

    <div id="modalBackDrop"></div>
    <div class="div_process_calendario"></div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/calendario.js"></script>
    <script src="../js/darkMode.js"></script>
    <script>
      console.log(data, titulo);
    </script>
</div>
</body>

</html>