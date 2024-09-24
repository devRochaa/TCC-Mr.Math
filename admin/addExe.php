<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Matéria</title>
  <link rel="stylesheet" href="../css/navbar.css?=<?php echo time(); ?>">
  <link rel="stylesheet" href="../css/addex.css?=<?php echo time(); ?>">

</head>

<body>
  <?php
  include("../conexao.php");
  include("../navbar.php");

  $sql = "SELECT nome FROM materia ORDER BY nome";
  $result = mysqli_query($conexao, $sql);
  $materias = mysqli_fetch_all($result, MYSQLI_ASSOC); // Recupera todas as matérias
  ?>
  <div class="cont">
    <form enctype="multipart/form-data" action="processex.php" method="POST">
      Matéria:
      <input type="text" name="materia" list="materias" placeholder="matemática...">
      <datalist id="materias">
        <?php
        foreach ($materias as $dados) {
          echo '<option value="' . htmlspecialchars($dados['nome']) . '">'; // Usando htmlspecialchars para evitar problemas
        }
        ?>
      </datalist>

      <br>
      <br>
      <label class="lbl" for="instituto">Instituto do exercício:</label>
      <input type="text" name="instituto" maxlength="10" placeholder="ENEM/Unesp..." required>

      <br>
      <br>

      <label class="lbl" for="enunciado">Enunciado do exercício:</label>
      <input type="text" name="enunciado" maxlength="1600" placeholder="matemática..." required>

      <br>
      <br>

      <div>
        <label class="lbl" for="numberInput">Quantidade de alternativas:</label>
        <input type="number" name="number" class="quantAlt" id="numberInput" min="1">
      </div>
      <div class="containerr" id="textInputsContainer">

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
      <button type="submit" name="acao">Cadastre exercício</button>
    </form>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const fileInput = document.getElementById('fileInput');
      const toggleButton = document.getElementById('toggleButton');

      toggleButton.addEventListener('click', function() {
        if (fileInput.disabled) {
          fileInput.disabled = false;
          toggleButton.textContent = 'Desativar Envio de Arquivos';
        } else {
          fileInput.disabled = true;
          toggleButton.textContent = 'Ativar Envio de Arquivos';
        }
      });

      function getLetter(index) {
        // Converte um índice numérico para a letra correspondente do alfabeto (A, B, C, ...)
        const charCode = 'A'.charCodeAt(0) + index;
        return String.fromCharCode(charCode);
      }

      document.getElementById('numberInput').addEventListener('input', function() {
        const numberInput = document.getElementById('numberInput');
        const textInputsContainer = document.getElementById('textInputsContainer');
        const numberOfInputs = parseInt(numberInput.value) || 0;

        // Limpa os inputs de texto existentes
        textInputsContainer.innerHTML = '';

        // Adiciona a quantidade de inputs de texto de acordo com o valor do input de número
        for (let i = 0; i < numberOfInputs; i++) {
          const inputGroup = document.createElement('div');
          inputGroup.className = 'input-group';

          const label = document.createElement('label');
          label.textContent = `${getLetter(i)}: `;
          inputGroup.appendChild(label);

          const textInput = document.createElement('input');
          textInput.type = 'text';
          textInput.name = `${getLetter(i)}`;
          inputGroup.appendChild(textInput);

          textInputsContainer.appendChild(inputGroup);
        }
      });
    });
  </script>
</body>

</html>