<?php
include("segurancaH.php");
include("admin.php");
?>
<label>
  <input class="nave" type="checkbox">
  <div class="toggle">
    <span class="top_line common"></span>
    <span class="middle_line common"></span>
    <span class="bottom_line common"></span>
  </div>

  <div class="slide">
    <h1 class="menu-h1">MENU</h1>
    <ul>
      <li><a class="burguer" href="menu.php"><i class="fas fa-tv"></i>Inicio</a></li>
      <li><a class="burguer" href="videos/selecionar.php"><i class="far fa-user"></i>Aulas</a></li>
      <li><a class="burguer" href="exercicio/exerciciosC.php"><i class="fab fa-gripfire"></i>Questões</a></li>
      <li><a class="burguer" href="#"><i class="far fa-comments"></i>Cronograma</a></li>
      <li><a class="burguer" href="#"><i class="far fa-folder"></i>Anotação</a></li>
      <li><a class="burguer" href="desempenho/desempenho.php"><i class="far fa-address-book"></i>Desempenho</a></li>
      <li><a class="burguer" href="#"><i class="far fa-heart"></i>dashbord</a></li>
      <li><a class="burguer" href="#"><i class="fas fa-cogs"></i>dashbord</a></li>
      <?php if ($admin == true) {
        echo "<li><a class='burguer' href='admin/adminpage.php'><i class='fas fa-cogs'></i>admin</a></li>";
      } ?>
    </ul>
  </div>
</label>

<div class="navbar">
  <div class="logo">
    <img class="logo_img" src="img/logo.png">
  </div>
  <ul>
    <li id="link"><a href="profile.php"><span class="material-symbols-outlined">account_circle</span></a></li>
  </ul>
</div>