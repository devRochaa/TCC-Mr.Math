<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Exercício</title>
  <link rel="stylesheet" href="../css/navbar.css?=<?php echo time(); ?>">
  <link rel="stylesheet" href="../css/addex.css?=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php
  include("../conexao.php");
  include("../navbar.php");

  $sql = "SELECT nome FROM materia ORDER BY nome";
  $result = mysqli_query($conexao, $sql);
  $materias = mysqli_fetch_all($result, MYSQLI_ASSOC);
  ?>
  <div class="container-addex">
    <form enctype="multipart/form-data" action="processex.php" method="POST" class="form-addex">
      <label for="materia" class="label-addex">Matéria:</label>
      <input type="text" id="materia" name="materia" list="materias" placeholder="matemática..." class="input-addex">
      <datalist id="materias">
        <?php
        foreach ($materias as $dados) {
          echo '<option value="' . htmlspecialchars($dados['nome']) . '">';
        }
        ?>
      </datalist>

      <label for="instituto" class="label-addex">Instituto do exercício:</label>
      <input type="text" id="instituto" name="instituto" maxlength="10" placeholder="ENEM/Unesp..." class="input-addex" required>

      <label for="enunciado" class="label-addex">Enunciado do exercício:</label>
      <input type="text" id="enunciado" name="enunciado" maxlength="1600" placeholder="Digite o enunciado..." class="input-addex" required>

      <input type="file" id="fileInput" name="imagem" class="input-addex" disabled>
      <button type="button" id="toggleButton" class="button-addex">Ativar Envio de Arquivos</button>

      <label for="numberInput" class="label-addex">Quantidade de alternativas:</label>
      <input type="number" id="numberInput" name="number" class="input-addex" min="1">

      <div class="alternativas-container" id="textInputsContainer"></div>

      <label for="resposta" class="label-addex">Resposta correta do exercício:</label>
      <input type="text" id="resposta" name="resposta" maxlength="60" placeholder="Digite a resposta..." class="input-addex" required>

      <label for="correcao_img" class="label-addex">Correção do exercício por imagem:</label>
      <input type="file" id="correcao_img" name="imagem2" class="input-addex">

      <label for="correcao" class="label-addex">Correção do exercício por vídeo:</label>
      <input type="text" id="correcao" name="correcao" class="input-addex" placeholder="Link do vídeo da correção..">

      <button type="submit" name="acao" class="button-addex-submit">Cadastrar exercício</button>
    </form>
  </div>
  <script src="../js/addex.js?=<?php echo time(); ?>"></script>
</body>

</html>