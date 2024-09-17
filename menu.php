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
    <link rel="stylesheet" href="css/menu.css?=<?php echo time(); ?>">
</head>


<body>
    <?php
    include("navbarH.php");
    if (!isset($_SESSION["usuario"])) {
        header("location: index.html");
        exit();
    }
    include("conexao.php");

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

    $sql = "SELECT id from usuarios where email = '$logado'";
    $result = $conexao->query($sql);
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
    }

    $sql = "SELECT aulas_assistidas, ex_feitos FROM desempenho where id_usuarios = $id";
    $result = $conexao->query($sql);
    while ($row = $result->fetch_assoc()) {
        $aulas_assistidas = $row['aulas_assistidas'];
        $ex_feitos = $row['ex_feitos'];
    }

    ?>

    <div class="container">
        <div class="corpo">
            <p>Olá <?php echo $nome ?>! Esse é a tela de início</p>
            <hr>
            <div class="banner">
                <img class="banner_img" src="img/banner_inicial.png">
            </div>
            <div class="box-aulas">
                <div class="barra-aulas">
                    <h2>Matematica Basica</h2>
                    <div id="porcentagem-aula">
                        <h3 id="porcentagem-aula-text"></h3>
                    </div>
                </div>
            </div>
            <div class="box-questoes">
                <div class="barra-questoes">
                    <h2>Matematica Basica</h2>
                    <div id="porcentagem-questoes">
                        <h3 id="porcentagem-questoes-text"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        var aulas_assistidas = "<?php echo $aulas_assistidas; ?>";
        var ex_feitos = "<?php echo $ex_feitos; ?>";

        var aulas_porcentagem = (aulas_assistidas / 10) * 100;
        var ex_porcentagem = (ex_feitos / 50) * 100;

        function atualizarBarra(percentualA, percentualQ) {
            var barraProgressoAula = document.getElementById("porcentagem-aula");
            var textoPorcentagemAula = document.getElementById("porcentagem-aula-text");
            var barraProgressoQuestoes = document.getElementById("porcentagem-questoes");
            var textoPorcentagemQuestoes = document.getElementById("porcentagem-questoes-text");

            barraProgressoAula.style.width = percentualA + "%";
            textoPorcentagemAula.innerText = percentualA + "%";
            barraProgressoQuestoes.style.width = percentualQ + "%";
            textoPorcentagemQuestoes.innerText = percentualQ + "%";
        }
        atualizarBarra(aulas_porcentagem, ex_porcentagem);

        // Exemplo de uso: Atualizar a barra para 70%
    </script>
</body>

</html>