<?php
    include("../conexao.php");
    $nome_materia= $_POST["nome_materia"];
    $descricao= $_POST['descricao'];
    $sql = "INSERT INTO materia(nome, descricao) VALUES ('$nome_materia', '$descricao')";
    if(mysqli_query($conexao, $sql)){
      echo"Matéria cadastrada <br>
      <a href='addmateria.php'><button>Voltar</button></a>";

    }
    else{
      echo "Erro".mysqli_connect_error($conexao);
    }
  ?>