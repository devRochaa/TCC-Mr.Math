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

      <input type="radio" name="Basica" id="eventTitleInput">
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


    <script src="../js/calendario.js"></script>
    <script src="../js/darkMode.js"></script>
</div>
</body>

</html>