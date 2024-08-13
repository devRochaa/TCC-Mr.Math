<?php
    include("../conexao.php");
    $nome_materia= $_POST["nome_materia"];
    $sql = "INSERT INTO materia(nome) VALUES ('$nome_materia')";
    if(mysqli_query($conexao, $sql)){
      echo"Matéria cadastrada";
    }
    else{
      echo "Erro".mysqli_connect_error($conexao);
    }
  ?>