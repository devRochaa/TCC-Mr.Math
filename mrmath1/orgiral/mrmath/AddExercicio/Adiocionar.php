<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Matéria</title>
  <style>
    div {
      display: flex;
      flex-direction: column;
    }

    label {
      display: flex;
      flex-direction: column;
    }

    .container {
      width: 20vw;
    }

    .quantAlt {
      width: 20vw;
    }
  </style>
</head>

<body>
  <?php
  include("../conexao.php");

  $sql = "SELECT nome FROM materia ORDER BY nome";
  $result = mysqli_query($conexao, $sql);
  $dados = mysqli_fetch_array($result);
  ?>
  <div>
    <form enctype="multipart/form-data" action="processex.php" method="POST">
      Matéria:
      <input type="text" name="materia" list="materias" placeholder="matemática...">
      <datalist id="materias">
        <?php
        foreach ($result as $dados) {
          echo '<option value=' . $dados['nome'] . '>';
        }
        ?>
      </datalist>

      <br>
      <br>
      <label for="instituto">Instuto do exercício:</label>
      <input type="text" name="instituto" maxlength="10" placeholder="ENEM/Unesp..." required>

      <br>
      <br>

      <label for="enunciado">Enunciado do exercício:</label>
      <input type="text" name="enunciado" maxlength="1600" placeholder="matemática..." required>

      <br>
      <br>

      <div>
        <label for="numberInput">Quantidade de alternativas:</label>
        <input type="number" name="number" class="quantAlt" id="numberInput" min="1">
      </div>
      <div class="container" id="textInputsContainer">

      </div>

      <br>
      <br>

      <label for="resposta">Resposta correta do exercício:</label>
      <input type="text" name="resposta" maxlength="60" placeholder="matemática..." required>

      <br>
      <br>

      <input type="file" id="fileInput" name="imagem" disabled>
      <button type="button" id="toggleButton">Ativar Envio de Arquivos</button>

      <br>
      <br>
      <button type="submit" name="acao">cadastre exercício</button>
    </form>
  </div>
  <script src="script.js"></script>
</body>

</html>