<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aulas</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/navbar.css?=<?php echo time(); ?>">
  <link rel="stylesheet" href="../css/video.css?=<?php echo time(); ?>">
</head>

<body>
  <?php
  include("../navbar.php");
  include("../conexao.php");

  if (isset($_POST['enviar'])) {
    $id_materia = $_POST['id_materia'];

    $sql = "SELECT id, nome_video, link, descricao from videos where id_materia = $id_materia";
    $result = mysqli_query($conexao, $sql);
  }
  if (isset($_GET['id_materia'])) {
    $id_materia = $_GET['id_materia'];

    $sql = "SELECT id, nome_video, link, descricao from videos where id_materia = $id_materia";
    $result = mysqli_query($conexao, $sql);
  }

  $videos = [];

  while ($row = $result->fetch_assoc()) {
    $videos[] = [
      'titulo' => $row['nome_video'],
      'link' => $row['link'],
      'descricao' => $row['descricao']
    ];
  }
  ?>

  <div class="container">

    <?php if (!empty($videos)) { ?>
      <div class="main-video-container">
        <iframe id='iframe' src="https://www.youtube.com/embed/<?php echo $videos[0]['link'] ?>?si=I8GP-52uZ6k_cpd-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <h3 class="main-vid-title" id="main-title"><?php echo $videos[0]['titulo']; ?></h3>
        <input id="assistida" type="checkbox"> <label>Marcar como assistida</label>
        <p style="margin-top: 2%" id="main-description"><?php echo $videos[0]['descricao']; ?></p>
      </div>
      <div class="video-list-container" id="videosList">
        <?php foreach ($videos as $video) { ?>
          <a id="<?php echo $video['link']; ?>" class='thumb' data-title="<?php echo $video['titulo']; ?>" data-description="<?php echo $video['descricao']; ?>">
            <img height='90vw' src='../img/banner7.png'>
            <p><?php echo $video['titulo']; ?></p>
          </a>
        <?php } ?>
      </div>
    <?php } else {
      echo $id_materia; ?>
      <p>Nenhum vídeo disponível no momento.</p>
    <?php } ?>

  </div>
  <?php if (!empty($videos)) { ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
      function trocarvideo() {
        var elements = document.getElementsByClassName('thumb');
        for (var i = 0; i < elements.length; i++) {
          elements[i].addEventListener('click', function(e) {
            var codigo = e.currentTarget.id;
            var title = e.currentTarget.getAttribute('data-title'); // Obtém o título
            var description = e.currentTarget.getAttribute('data-description'); // Obtém a descrição

            // Atualiza o iframe com o novo vídeo
            document.getElementById("iframe").src = 'https://www.youtube.com/embed/' + codigo;

            // Atualiza o título e a descrição
            document.getElementById("main-title").innerText = title;
            document.getElementById("main-description").innerText = description;
          });
        }
      }

      trocarvideo(); // Chama a função para adicionar os event listeners

      // Função para gerenciar cookies
      function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${value}; expires=${date.toUTCString()}; path=/`;
      }

      function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
      }

      $(document).ready(function() {
        const email = "<?php echo $_SESSION['usuario']; ?>";

        // Recupera o estado do checkbox do cookie
        const assistidaCookie = getCookie(`assistida_${email}`);
        if (assistidaCookie === "true") {
          $("#assistida").prop("checked", true);
        }

        // Evento de clique no checkbox
        $("#assistida").change(function() {
          const isChecked = $(this).is(":checked");

          // Atualiza o cookie
          setCookie(`assistida_${email}`, isChecked, 30);

          // Faz a requisição AJAX para atualizar a tabela
          $.ajax({
            type: 'POST',
            url: 'updateVideo.php',
            data: {
              assistido: isChecked ? 1 : -1, // Envia 1 para adicionar, -1 para remover
              email: email
            },
            success: function(response) {
              console.log("Atualização no banco realizada com sucesso.");
            },
            error: function(xhr, status, error) {
              console.error("Erro ao atualizar o banco:", xhr.responseText);
            }
          });
        });
      });
    </script>
  <?php } ?>
</body>

</html>