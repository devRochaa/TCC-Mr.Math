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
    <link rel="stylesheet" href="../css/exercicios.css">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
</head>

<body>
    <?php
    include("../seguranca.php");
    include("../navbar.php");

    ?>

    <div class="container">
        <div class="corpo">
            <div class="cima">
                <p class="ex">EXERCICIOS</p>
                <hr>
                <p>Olá <?php echo $nome ?>! Esse é a tela de exercicios</p>
            </div>


            <div class="question-containerr hide">
                <span class="question">Pergunta aqui</span>
                <div class="answers-containerr">
                    <button class="answer button">a</button>
                    <button class="answer button">b</button>
                    <button class="answer button">c</button>
                    <button class="answer button">d</button>
                </div>
            </div>

            <div class="features">
                <div class="cards">
                    <div class="card">
                        <h4>Exercícios Soma e subtracao</h4>
                        <p>
                            7 exercicios sobre soma e subtracao para seu estudo
                        </p>
                        <div class="controls-start">
                            <div class="start-quiz button">Comecar</div>
                        </div>
                    </div>
                    <div class="card">
                        <h4>Exercícios Divisao e multiplicaçãoS</h4>
                        <p>
                            7 exercicios sobre divisao e multiplicação para seu estudo
                        </p>
                        <div class="controls-start">
                            <div class="start-quiz button">Comecar</div>
                        </div>
                    </div>
                    <div class="card">
                        <h4>Exercícios Fracao e Equacao</h4>
                        <p>
                            7 exercicios tendo fracoes e equacoes para seu estudos
                        </p>
                        <div class="controls-start">
                            <div class="start-quiz button">Comecar</div>
                        </div>
                    </div>
                    <div class="card">
                        <h4>Exercícios graficos</h4>
                        <p>
                            7 exercicios com graficos para seu estudos
                        </p>
                        <div class="controls-start">
                            <div class="start-quiz button">Comecar</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="controls-next">
                <div class="next-quiz button hide">></div>
            </div>
        </div>
    </div>



    <script src="../js/exercicios.js"></script>
</body>

</html>