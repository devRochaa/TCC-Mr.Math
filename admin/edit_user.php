<?php
include("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_POST['user_id']);
  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $bio = $_POST['bio'];
  $rm = $_POST['rm'];

  $sql = "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', telefone = '$telefone', bio = '$bio', rm = '$rm' WHERE id = $id";
  $sqle = "UPDATE usuarios SET nome = ?, sobrenome = ?, email = ?, telefone = ?, bio = ?, rm = ? WHERE id = ?";
//   $stmt = $conexao->prepare($sql);
//   $stmt->bind_param("ssssssi", $nome, $sobrenome, $email, $telefone, $bio, $id, $rm);

//   if ($stmt->execute()) {
//     echo "Usuário atualizado com sucesso.";
//   } else {
//     echo "Erro ao atualizar o usuário.";
//   }
if(mysqli_query($conexao, $sql)){
    echo"Informações Atualizadas<br>
    <a href='adminpage.php'><button>Voltar</button></a>";
    header("location: adminpage.php");
  }
  else{
    echo "Erro".mysqli_connect_error($conexao);
  }
}
?>
