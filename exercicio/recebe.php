<?php

if (isset($_POST['enviar'])) {
  session_start();
  $_SESSION['id_materia'] = $_POST['id_materia'];
  header('Location:exerciciosC.php');
}
