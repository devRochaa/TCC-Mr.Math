<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aulas</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="../css/video.css?=<?php echo time(); ?>">
</head>

<body>
  <?php
  include("../navbar.php");
  include("../conexao.php");

  $sql = "SELECT id, nome_video, link, id_materia, descricao from videos";
  $result = mysqli_query($conexao, $sql);
  while ($row = $result->fetch_assoc()) {
    $videos[] = [
      'titulo' => $row['nome_video'],
      'link' => $row['link'],
      'id_materia' => $row['id_materia'],
      'descricao' => $row['descricao']
    ];
  }
  ?>
  <div class=" container">
    <div class="main-video-container">
      <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $videos[0]['link'] ?>?si=I8GP-52uZ6k_cpd-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      <h3 class="main-vid-title">3D helicopter animation</h3>
    </div>
    <div class="video-list-container" id="videosList">
      <?php foreach ($videos as $video) {
        echo "<a onclick=trocarvideo()> <img height='90vw' src='../img/banner7.png'>
       <p> ", $video['titulo'], "</p></a>";
      } ?>


    </div>
  </div>

  <script src="Videoplaylist.js">
    function trocarvideo() {

    }
  </script>

</html>