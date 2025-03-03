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
    date_default_timezone_set('America/Sao_Paulo');

    $logado = $_SESSION["usuario"];
    $nome = $_SESSION['nome'];



    $sql = "SELECT id from usuarios where email = '$logado'";
    $result = $conexao->query($sql);
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];                                           //ID
        $_SESSION['id'] = $id;
    }



    
    $sql = "SELECT aulas_assistidas, ex_feitos FROM desempenho where id_usuarios = $id";
    $result = $conexao->query($sql);
    while ($row = $result->fetch_assoc()) {
        $aulas_assistidas = $row['aulas_assistidas'];
        $ex_feitos = $row['ex_feitos'];
    }

    $sql = "SELECT id from videos";
    $resultado = mysqli_query($conexao, $sql);
    $qtd_videos = mysqli_affected_rows($conexao);

    $sql = "SELECT id from exercicios";
    $resultado = mysqli_query($conexao, $sql);
    $qtd_exercicios = mysqli_affected_rows($conexao);

    ?>

    <div class="container">
        <div class="notif">
            <img src="img/notificacao.png" id="notif-button" class="notif_img" onclick="MostrarNotif()">
            <?php 
            $sql = "SELECT titulo, data from calendario where id_usuario = '$id'";
            $result = $conexao->query($sql);
             while ($row = $result->fetch_assoc()) {
                if (date("Y-m-d") == $row['data']) {
                    echo "<div id='bolinha' class='bolinhaNotif'>ㅤ</div>";
                }
            }
            ?>
        </div>
        <div class="corpo">
            <p>Olá <?php echo $nome ?>! Esse é a tela de início</p>
            <hr>
           
            <div class="banner">
                <img class="banner_img" src="img/banner_inicial.png">
            </div>
            <div class="box-aulas">
                <div class="barra-aulas">
                    <h2>Aulas Assisitidas</h2>
                    <div id="porcentagem-aula">
                        <h3 id="porcentagem-aula-text"></h3>
                    </div>
                </div>
            </div>
            <div class="box-questoes">
                <div class="barra-questoes">
                    <h2>Questões Feitas</h2>
                    <div id="porcentagem-questoes">
                        <h3 id="porcentagem-questoes-text"></h3>
                    </div>
                </div>
            </div>
        </div>

        <div id="centralC" class="central-container">
            <div class="central-div">
                <div class='fecharnotif'onclick="FecharNotif()"><i class="fa-regular fa-circle-xmark fa-2x"></i></div>
                <?php
                    $sql = "SELECT titulo, data from calendario where id_usuario = '$id'";
                    $result = $conexao->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    if (date("Y-m-d") == $row['data']) {
                        echo '<p>Você tem uma atividade marcada para hoje:</p>';
                        echo "<h3>" . $row['titulo'] ."</h3>";
                        $tem = true;
                    }
                }
                if (!$tem){
                    echo '<p>Você não tem nenhuma atividade marcada para hoje.</p>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php

    ?>

    <script>
      
      if (sessionStorage.getItem("notif") === null) {
    sessionStorage.setItem("notif", "0"); // Define como "0" apenas na primeira vez
}


        var aulas_assistidas = "<?php echo $aulas_assistidas; ?>";
        var ex_feitos = "<?php echo $ex_feitos; ?>";
        var total_aulas = "<?php echo $qtd_videos; ?> ";
        var total_ex = "<?php echo $qtd_exercicios; ?>";


        var aulas_porcentagem = (aulas_assistidas / total_aulas) * 100;
        if (aulas_porcentagem > 100) {
            aulas_porcentagem = 100;
        }
        var ex_porcentagem = (ex_feitos / total_ex) * 100;
        if (ex_porcentagem > 100) {
            ex_porcentagem = 100;
        }

        function atualizarBarra(percentualA, percentualQ) {
            var barraProgressoAula = document.getElementById("porcentagem-aula");
            var textoPorcentagemAula = document.getElementById("porcentagem-aula-text");
            var barraProgressoQuestoes = document.getElementById("porcentagem-questoes");
            var textoPorcentagemQuestoes = document.getElementById("porcentagem-questoes-text");
            
            

            barraProgressoAula.style.width = percentualA + "%";
            textoPorcentagemAula.innerText = Math.pow(parseInt(percentualA), 1) + "%";
            barraProgressoQuestoes.style.width = percentualQ + "%";
            textoPorcentagemQuestoes.innerText = Math.pow(parseInt(percentualQ), 1) + "%";
        }
        atualizarBarra(aulas_porcentagem, ex_porcentagem);

        const CentrarContainer = document.getElementById("centralC");
        const bolinhaVer = document.getElementById("bolinha")
        if (sessionStorage.getItem("notif") === "0") {
    bolinhaVer.style.display = 'block'; // Mostra a bolinha se notif for "0"
} else {
    bolinhaVer.style.display = 'none'; // Esconde a bolinha caso contrário
}
        function MostrarNotif (){
            
            bolinhaVer.style.display = 'none'
            sessionStorage.setItem("notif", "1");
            CentrarContainer.style.display = 'block';

        }

        function FecharNotif(){
            bolinhaVer.style.display = 'none'
            CentrarContainer.style.display = 'none';
        }
    </script>
</body>

</html>