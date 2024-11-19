<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Matéria</title>
  <link rel="stylesheet" href="../css/navbar.css?=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php
  include("../conexao.php");
  include("../navbar.php");
  ?>
  <form action="processmateria.php" method="post" enctype="multipart/form-data">
    <label for="nome_materia">Nome da matéria:</label>
    <input type="text" name="nome_materia" maxlength="50" placeholder="matemática..." required>

    <label for="nome_materia">Descrição da matéria:</label>
    <input type="text" name="descricao" maxlength="150" placeholder="fale sobre a materia" required>

    <label for="correcao_img" class="label-addex">Foto da matéria</label>
    <input type="file" id="foto_materia" name="foto_materia" accept="image/jpeg, image/png">

    <br>
    <button type="submit">cadastre materia</button>

  </form>
</body>

</html>