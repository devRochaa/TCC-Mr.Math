<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Matéria</title>
</head>
<body>
<form action="processmateria.php" method="POST">
  <label for="nome_materia">Nome da matéria:</label>
  <input type="text" name="nome_materia" maxlength="60" placeholder="matemática..." required>
  <button type="submit">cadastre materia</button>
</form>
</body>
</html>