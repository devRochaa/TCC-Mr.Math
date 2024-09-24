<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página do Administrador</title>
  <link rel="stylesheet" href="../css/navbar.css?=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    .user-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .user-list li {
      background-color: white;
      border: 1px solid #1E38E6;
      border-radius: 10px;
      margin-bottom: 15px;
      padding: 20px;
      transition: background-color 0.3s ease;
    }

    .user-list li:hover {
      background-color: #e6f0ff;
    }

    .user-list h2 {
      color: #1E38E6;
      margin-bottom: 10px;
    }

    .user-list p {
      color: #555;
      margin: 5px 0;
    }

    strong {
      color: #1E38E6;
    }

    .btn-add {
      font-size: 11px;
      display: flex;
      background-color: transparent;
      border: 2px solid #143699;
      border-radius: 10px;
      padding: 0.75rem;
      color: #143699;
      font-weight: 550;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-left: 45%;
    }

    .div-botao {
      padding: 5%;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>


<?php
include("../navbar.php");
include("../conexao.php");

$sql = "SELECT nome, sobrenome, email, senha, rm, telefone, bio FROM usuarios";
$result = mysqli_query($conexao, $sql);

?>
<div class="div-botao">

  <a href="addvideo.php" style="text-decoration:none;"><button class="btn-add" type="button">Adicionar vídeos</button></a>
  <a href="addExe.php" style="text-decoration:none;"><button class="btn-add" type="button">Adicionar exercícios</button></a>
  <a href="addmateria.php" style="text-decoration:none;"><button class="btn-add" type="button">Adicionar Matéria</button></a>

</div>

<?php
if (mysqli_num_rows($result) > 0) {
  echo '<ul class="user-list">';
  while ($usuario = mysqli_fetch_assoc($result)) {
    echo '<li>';
    echo '<h2>' . $usuario['nome'] . ' ' . $usuario['sobrenome'] . '</h2>';
    echo '<p><strong>Email:</strong> ' . $usuario['email'] . '</p>';
    echo '<p><strong>RM:</strong> ' . $usuario['rm'] . '</p>';
    echo '<p><strong>Telefone:</strong> ' . $usuario['telefone'] . '</p>';
    echo '<p><strong>Bio:</strong> ' . $usuario['bio'] . '</p>';
    echo '<button>Editar</button>';
    echo '</li>';
  }
  echo '</ul>';
} else {
  echo '<p>Nenhum usuário encontrado.</p>';
}
?>

</body>

</html>