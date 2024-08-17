<?php
include("../conexao.php");

if (isset($_POST['enviar'])) {
  //formulário enviado
  $arquivo = $_FILES['arquivo'];

  $arquivoNovo = explode('.', $arquivo['name']);

  if ($arquivoNovo[sizeof($arquivoNovo) - 1] != 'mp4') {
    die("Você só pode fazer upload de arquivos mp4");
  } else {
    $link = $arquivo['name'];
    $materia = $_POST['materia'];
    $nomev = $_POST['nomev'];
    $descricao = $_POST['descricao'];

    //pega id de mateira
    $sql = "SELECT id from materia WHERE nome = '$materia'";
    $result = mysqli_query($conexao, $sql);
    while ($row = $result->fetch_assoc()) {
      $id_materia = $row['id'];
    }
    $sql = "INSERT INTO videos(nome_video, id_materia, descricao, link) VALUES('$nomev','$id_materia','$descricao','../img/video/$link')";
    if (mysqli_query($conexao, $sql)) {
      move_uploaded_file($arquivo['tmp_name'], '../img/video/' . $arquivo['name']);
      echo "video enviado <br>";
      echo "<a href='addvideo.php'><button> Voltar </button> </a>";
    }
  }
}
