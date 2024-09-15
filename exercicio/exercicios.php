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



    <script>
        const $startGameButton = document.querySelector(".start-quiz")
        const $nextQuestionButton = document.querySelector(".next-quiz")
        const $container = document.querySelector(".cima")
        const $questionsContainer = document.querySelector(".question-containerr")
        const $answersContainer = document.querySelector(".answers-containerr")
        const $questionText = document.querySelector(".question")
        const $cardQuestion = document.querySelector(".features")



        $startGameButton.addEventListener("click", startGame)
        $nextQuestionButton.addEventListener("click", displayNextQuestion)

        let currentQuestionIndex = 0
        let totalCorrect = 0

        function startGame() {
            $startGameButton.classList.add("hide")
            $cardQuestion.classList.add("hide")
            $questionsContainer.classList.remove("hide")
            $container.classList.add("hide")
            displayNextQuestion()
        }


        function displayNextQuestion() {
            resetState()

            if (questions.length === currentQuestionIndex) {
                return finishGame()
            }

            $questionText.textContent = questions[currentQuestionIndex].question
            questions[currentQuestionIndex].answers.forEach(answer => {
                const newAnswer = document.createElement("button")
                newAnswer.classList.add("button", "answer")
                newAnswer.textContent = answer.text
                if (answer.correct) {
                    newAnswer.dataset.correct = answer.correct
                }
                $answersContainer.appendChild(newAnswer)

                newAnswer.addEventListener("click", selectAnswer)
            })
        }

        function resetState() {
            while ($answersContainer.firstChild) {
                $answersContainer.removeChild($answersContainer.firstChild)
            }

            document.body.removeAttribute("class")
            $nextQuestionButton.classList.add("hide")
        }

        function selectAnswer(event) {
            const answerClicked = event.target;
            const isCorrect = answerClicked.dataset.correct;

            // Remove classes from all buttons
            document.querySelectorAll(".answer").forEach(button => {
                button.classList.remove("correct", "incorrect");
                button.disabled = true; // Disable all buttons after a selection
            });

            // Add correct/incorrect class based on the clicked answer
            if (isCorrect) {
                answerClicked.classList.add("correct");
                totalCorrect++;
            } else {
                answerClicked.classList.add("incorrect");

                // Highlight the correct answer
                document.querySelectorAll(".answer").forEach(button => {
                    if (button.dataset.correct) {
                        button.classList.add("correct");
                    }
                });
            }

            // Show the next question button
            $nextQuestionButton.classList.remove("hide");
            currentQuestionIndex++;
        }


        function finishGame() {
            const totalQuestions = questions.length
            const performance = Math.floor(totalCorrect * 100 / totalQuestions)

            let message = ""

            switch (true) {
                case (performance >= 90):
                    message = "excelente :)"
                    break
                case (performance >= 70):
                    message = "muito bom :)"
                    break
                case (performance >= 50):
                    message = "bom"
                    break
                default:
                    message = "pode melhorar :("
            }

            $questionsContainer.innerHTML =
                `
  <p class="final-message">
    Você acertou ${totalCorrect} de ${totalQuestions} questões!
    <span>Resultado: ${message}</span>
  </p>
  <button 
    onclick=window.location.reload() 
    class="button"
  >
    Refazer teste
  </button>
`
        }




















        const questions = [{
                question: "Quanto é 2 + 4 + 2",
                answers: [{
                        text: "4",
                        correct: false
                    },
                    {
                        text: "9",
                        correct: false
                    },
                    {
                        text: "8",
                        correct: true
                    },
                    {
                        text: "6",
                        correct: false
                    }
                ]
            },
            {
                question: "Onde é o lugar correto para inserir JavaScript?",
                answers: [{
                        text: "Tanto no <head> quanto no <body> está correto",
                        correct: true
                    },
                    {
                        text: "No <body>",
                        correct: false
                    },
                    {
                        text: "No <head>",
                        correct: false
                    },
                    {
                        text: "Em outro lugar",
                        correct: false
                    }
                ]
            },
            {
                question: 'Qual é a sintaxe correta para se referir a um script externo chamado "xxx.js"',
                answers: [{
                        text: '<script src="xxx.js">',
                        correct: true
                    },
                    {
                        text: '<script href="xxx.js">',
                        correct: false
                    },
                    {
                        text: '<script name="xxx.js">',
                        correct: false
                    },
                    {
                        text: "Nenhuma das alternativas",
                        correct: false
                    }
                ]
            },
            {
                question: 'O arquivo JavaScript externo deve conter a tag <script>',
                answers: [{
                        text: "Verdadeiro",
                        correct: false
                    },
                    {
                        text: "Falso",
                        correct: true
                    }
                ]
            },
            {
                question: 'Como escrever "Hello World" numa caixa de alerta?',
                answers: [{
                        text: 'msg("Hello World");',
                        correct: false
                    },
                    {
                        text: 'alert("Hello World");',
                        correct: true
                    },
                    {
                        text: 'msgBox("Hello World");',
                        correct: false
                    },
                    {
                        text: 'alertBox("Hello World");',
                        correct: false
                    }
                ]
            },
            {
                question: 'Como podemos criar uma função no JavaScript?',
                answers: [{
                        text: 'function:myFunction()',
                        correct: false
                    },
                    {
                        text: 'function myFunction()',
                        correct: true
                    },
                    {
                        text: 'function = myFunction()',
                        correct: false
                    },
                    {
                        text: 'Nenhum desses códigos criaria uma função',
                        correct: false
                    }
                ]
            },
            {
                question: 'Como podemos chamar uma função chamada "minhaFuncao"?',
                answers: [{
                        text: 'call minhaFuncao()',
                        correct: false
                    },
                    {
                        text: 'call function minhaFuncao()',
                        correct: false
                    },
                    {
                        text: 'Nenhum desses códigos chamaria essa função',
                        correct: false
                    },
                    {
                        text: 'minhaFuncao()',
                        correct: true
                    },
                ]
            },
        ]
    </script>
</body>

</html>
<?php ob_end_flush(); ?>