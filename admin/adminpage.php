<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página do Administrador</title>
  <link rel="stylesheet" href="../css/admin.css?=<?php echo time(); ?>">
  <link rel="stylesheet" href="../css/navbar.css?=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<?php
include("../navbar.php");
include("../conexao.php");

$sql = "SELECT id, nome, sobrenome, email, senha, rm, telefone, bio FROM usuarios";
$result = mysqli_query($conexao, $sql);

?>
<div id="edit-form-container" style="display: none;">
  <form action="edit_user.php" method="POST">
    <input type="hidden" name="user_id" id="user-id" value="">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" required>
    <label for="sobrenome">Sobrenome:</label>
    <input type="text" name="sobrenome" id="sobrenome" required>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <label for="telefone">Telefone:</label>
    <input type="text" name="telefone" id="telefone">
    <label for="rm">RM:</label>
    <input type="text" name="rm" id="rm">
    <label for="bio">Bio:</label>
    <textarea name="bio" id="bio"></textarea>
    <button type="submit">Salvar</button>
    <button type="button" onclick="document.querySelector('#edit-form-container').style.display='none';">Cancelar</button>
  </form>
</div>

<div class="div-botao">

  <a href="addvideo.php" style="text-decoration:none;"><button class="btn-video" type="button">Adicionar vídeos</button></a>
  <a href="addExe.php" style="text-decoration:none;"><button class="btn-ex" type="button">Adicionar exercícios</button></a>
  <a href="addmateria.php" style="text-decoration:none;"><button class="btn-mate" type="button">Adicionar Matéria</button></a>

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
    echo '<button class="btn-editar" data-id="' . $usuario['id'] . '">Editar</button>'; // Usando o ID aqui
    echo '</li>';
  }
  echo '</ul>';
} else {
  echo '<p>Nenhum usuário encontrado.</p>';
}
?>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const editButtons = document.querySelectorAll(".btn-editar");

    editButtons.forEach((button) => {
      button.addEventListener("click", (e) => {
        const userId = button.getAttribute("data-id");
        const formContainer = document.querySelector("#edit-form-container");

        // Mostra o formulário
        formContainer.style.display = "block";

        // Define o valor do campo hidden para o ID do usuário
        document.querySelector("#user-id").value = userId;

        // Opcional: Buscar dados do usuário para preencher o formulário
        fetch(`get_user.php?id=${userId}`)
          .then(response => response.json())
          .then(data => {
            document.querySelector("#nome").value = data.nome;
            document.querySelector("#sobrenome").value = data.sobrenome;
            document.querySelector("#email").value = data.email;
            document.querySelector("#telefone").value = data.telefone;
            document.querySelector("#bio").value = data.bio;
            document.querySelector("#rm").value = data.rm;
          });
      });
    });
  });
</script>
</body>

</html>