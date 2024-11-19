<?php
include("../conexao.php");

if (isset($_POST['enviar'])) {
  $materia = $_POST['materia'];
  $nomev = $_POST['nomev'];
  $descricao = $_POST['descricao'];

  // Obtém o ID da matéria
  $sql = "SELECT id FROM materia WHERE nome = '$materia'";
  $result = mysqli_query($conexao, $sql);
  while ($row = $result->fetch_assoc()) {
    $id_materia = $row['id'];
  }

  // Processa o link do vídeo
  $link = $_POST['link'];
  $linkcerto = explode("=", $link);
  $savelink = $linkcerto[1];

  // Define a imagem padrão
  $thumb_path = "../img/aulas.png";

  // Processa o upload da imagem se for enviado um arquivo
  if (isset($_FILES['thumb_video']) && $_FILES['thumb_video']['error'] == 0) {
    $allowed_types = ['image/png', 'image/jpeg', 'image/jpg'];
    $file_type = $_FILES['thumb_video']['type'];
    $file_name = $_FILES['thumb_video']['name'];
    $file_tmp = $_FILES['thumb_video']['tmp_name'];
    $upload_dir = "../img/thumbVideo/";

    // Verifica o tipo do arquivo
    if (in_array($file_type, $allowed_types)) {
      // Cria um nome único para evitar conflitos
      $new_file_name = uniqid() . "_" . basename($file_name);
      $upload_path = $upload_dir . $new_file_name;

      // Move o arquivo para o diretório de uploads
      if (move_uploaded_file($file_tmp, $upload_path)) {
        $thumb_path = "../img/thumbVideo/" . $new_file_name; // Caminho a ser salvo no banco
      } else {
        die("Erro ao salvar o arquivo no servidor.");
      }
    } else {
      die("Formato de arquivo inválido. Apenas PNG, JPG e JPEG são permitidos.");
    }
  }

  // Insere os dados no banco de dados
  $sql = "INSERT INTO videos(nome_video, id_materia, descricao, link, thumb_video) VALUES('$nomev', '$id_materia', '$descricao', '$savelink', '$thumb_path')";
  if (mysqli_query($conexao, $sql)) {
    session_start();
    $_SESSION['VideoEnviado'] = true;
    header("Location:addvideo.php");
  } else {
    die("Erro ao inserir os dados no banco: " . mysqli_error($conexao));
  }
}
