<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Burguer</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/menu.css">
</head>


<body>
    <?php
    session_start();
    include("conexao.php");
    if (!isset($_SESSION["usuario"]) ==  true) {
        unset($_SESSION["usuario"]);
        header("../login/inicio.php");
    }

    $logado = $_SESSION["usuario"];

    $sql = "SELECT nome FROM usuarios WHERE email = '$logado'";
    $con = mysqli_query($conexao, $sql);
    if ($con->num_rows > 0) {
        // Saída de dados de cada linha
        while ($row = $con->fetch_assoc()) {
            $nome = $row["nome"];
        }
    }
    $_SESSION['nome'] = $nome;
    mysqli_close($conexao);

    include("navbarH.php")
    ?>

    <div class="container">
        <div class="corpo">
            <p>Olá <?php echo $nome ?>! Esse é a tela de início</p>
            <hr>
            <div class="banner">
                <img class="banner_img" src="img/bannerMenu.png">
            </div>
            <div class="box-aulas">
                <div class="barra-aulas">
                    <h2>Matematica Basica</h2>
                    <div class="porcentagem-aula">
                        <h3>25%</h3>
                    </div>
                </div>
            </div>
            <div class="box-questoes">
                <div class="barra-questoes">
                    <h2>Matematica Basica</h2>
                    <div class="porcentagem-questoes">
                        <h3>55%</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div id="barra-container">
    <div id="barra-progresso"></div>
    </div>
    <p id="porcentagem-texto">0%</p>

    <script>
        function atualizarBarra(percentual) {
    var barraProgresso = document.getElementById("barra-progresso");
    var textoPorcentagem = document.getElementById("porcentagem-texto");
    
    barraProgresso.style.width = percentual + "%";
    textoPorcentagem.innerText = percentual + "%";
}

    // Exemplo de uso: Atualizar a barra para 70%
    atualizarBarra(80);
    </script>
</body>

</html>