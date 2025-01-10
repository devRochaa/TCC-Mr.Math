<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Exercícios</title>
    <link rel="stylesheet" href="../css/navbar.css?=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/exercicios.css?=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    include("../navbar.php");
    include("../conexao.php");

    if (isset($_POST['enviar'])) {
        $id_materia = $_POST['id_materia'];
    }
    ?>
    <div class="corpo">
        <h1 class="main-title">Exercícios</h1>
        <div id="quiz-container"></div>
        <div>
            <h2>Acertos: <span id="score">0</span></h2>
        </div>

        <button id="next-question" class="next-button" onclick="showNextQuestion()">Próxima Questão</button>
        <button id="show-button" class="show-button" hidden>Mostrar Correção</button>

        <div id="updiv" class="updiv">
            <button class="close-button" onclick="document.getElementById('updiv').style.display = 'none'"><i class="fa-regular fa-circle-xmark fa-2x"></i></button>
            <img class="centered-image" src="">
        </div>



    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script>
        function fetchCorrectionImage(id_imagem, questionIndex) {
            $.ajax({
                type: 'POST',
                url: 'api_imagem.php', // Endpoint onde o PHP irá buscar a imagem
                data: {
                    id: id_imagem
                },
                dataType: 'json',
                success: function(response) {
                    // Verifica se a resposta contém a base64
                    if (response.imageBase64) {
                        // Seleciona a div específica da questão atual
                        const correctionDiv = document.querySelector(`#updiv-${questionIndex}`);
                        const correctionImage = correctionDiv.querySelector('img');

                        // Se não houver imagem na updiv, cria uma nova
                        if (!correctionImage) {
                            const newImage = document.createElement('img');
                            newImage.classList.add('centered-image');
                            correctionDiv.appendChild(newImage);
                        }

                        // Atualiza o src da imagem na updiv
                        correctionDiv.querySelector('img').src = 'data:image/jpeg;base64,' + response.imageBase64;
                    } else {
                        console.log('Imagem não encontrada ou não retornada corretamente.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao buscar imagem:', error);
                }
            });
        }

        function fetchImageBase64(id_imagem, questionElement) {
            $.ajax({
                type: 'POST',
                url: 'api_imagem.php',
                data: {
                    id: id_imagem
                },
                dataType: 'json',
                success: function(response) {
                    if (response.imageBase64) {
                        const imageElement = document.createElement('img');
                        imageElement.src = 'data:image/jpeg;base64,' + response.imageBase64;
                        imageElement.alt = 'Imagem da questão';
                        imageElement.classList.add('question-image');
                        questionElement.insertBefore(imageElement, questionElement.querySelector('.answer-input') || null);
                    } else {
                        console.log('Imagem não encontrada ou não retornada corretamente.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao buscar imagem:', error);
                }
            });
        }

        let score = 0;
        let currentQuestionIndex = 0;

        const quizContainer = document.getElementById('quiz-container');
        const scoreDisplay = document.getElementById('score');
        const nextButton = document.getElementById('next-question');
        const mostrarButton = document.getElementById('show-button');
        const updiv = document.getElementById("updiv");

        mostrarButton.addEventListener('click', function() {
            // Exibe a updiv da questão ativa
            const activeQuestionIndex = currentQuestionIndex;
            const correctionDiv = document.querySelector(`#updiv-${activeQuestionIndex}`);
            correctionDiv.style.display = 'block'; // Mostrar a updiv da correção

            // Carregar a imagem de correção para a questão ativa
            const questionData = quizData[activeQuestionIndex];
            if (questionData.id_correcao) {
                fetchCorrectionImage(questionData.id_correcao, activeQuestionIndex);
            }
        });

        async function loadQuestions() {
            try {
                const response = await fetch('api.php');
                const quizData = await response.json();
                loadQuiz(quizData);
            } catch (error) {
                console.error('Erro ao carregar as questões:', error);
            }
        }

        let correcao = {};

        function loadQuiz(quizData) {
            quizData.forEach((questionData, index) => {
                const questionElement = document.createElement('div');
                questionElement.classList.add('question');
                if (index === 0) questionElement.classList.add('active'); // Apenas a primeira questão será visível inicialmente

                const questionTitle = document.createElement('h3');
                questionTitle.classList.add('question-title');
                questionTitle.textContent = `${index + 1}. ${questionData.questao}`;
                questionElement.appendChild(questionTitle);

                // Adicionar a div de correção única para cada questão
                const updiv = document.createElement('div');
                updiv.id = `updiv-${index}`;
                updiv.classList.add('updiv');
                updiv.style.display = 'none'; // Inicialmente escondido

                // Criar e adicionar o botão de fechamento dentro da updiv
                const closeButton = document.createElement('button');
                closeButton.classList.add('close-button');
                closeButton.innerHTML = '<i class="fa-regular fa-circle-xmark fa-2x"></i>';
                closeButton.onclick = function() {
                    updiv.style.display = 'none'; // Esconde a updiv
                };

                updiv.appendChild(closeButton); // Adiciona o botão de fechamento na updiv

                questionElement.appendChild(updiv); // Adiciona a updiv ao elemento da questão

                // Chama a função para carregar a imagem com o ID da imagem da questão
                if (questionData.id_imagem) {
                    fetchImageBase64(questionData.id_imagem, questionElement);
                }

                if (questionData.correcao_link) {
                    correcao.variavel = questionData.correcao_link;
                }

                if (questionData.id_correcao) {
                    fetchCorrectionImage(questionData.id_correcao, index); // Passa o índice da questão para a função
                }

                // Criação das alternativas
                const allAnswers = [...questionData.alternativasErradas, questionData.alternativaCorreta];
                shuffleArray(allAnswers);

                allAnswers.forEach(answer => {
                    const input = document.createElement('input');
                    const label = document.createElement('label');

                    input.type = 'radio';
                    input.classList.add('answer-input');

                    input.name = `question${index}`;
                    input.value = answer;
                    input.id = `answer${index}-${answer}`;

                    label.setAttribute('for', input.id);
                    label.textContent = answer;
                    label.classList.add('answer-label');

                    questionElement.appendChild(input);
                    questionElement.appendChild(label);
                });

                const submitButton = document.createElement('button');
                submitButton.textContent = 'Enviar';
                submitButton.classList.add('submit-button');
                submitButton.onclick = () => checkAnswer(questionData, index, submitButton);
                questionElement.appendChild(submitButton);

                const correctAnswerText = document.createElement('p');
                correctAnswerText.textContent = `Resposta correta: ${questionData.alternativaCorreta}`;
                correctAnswerText.classList.add('hidden', 'correct-answer');
                questionElement.appendChild(correctAnswerText);

                quizContainer.appendChild(questionElement);
            });


        }


        function checkAnswer(questionData, questionIndex, button) {
            const inputs = document.querySelectorAll(`input[name="question${questionIndex}"]`);
            let userAnswer = '';

            inputs.forEach(input => {
                if (input.checked) {
                    userAnswer = input.value;
                }
            });

            if (userAnswer === '') {
                alert('Por favor, selecione uma resposta.');
                return;
            }

            button.disabled = true;
            mostrarButton.hidden = false;

            inputs.forEach(input => {
                const label = input.nextElementSibling;

                if (input.value === questionData.alternativaCorreta) {
                    label.classList.add('correct');
                } else if (input.checked && input.value !== questionData.alternativaCorreta) {
                    label.classList.add('wrong');
                }

                input.checked = false;
            });

            const correctAnswerText = document.querySelectorAll('.correct-answer')[questionIndex];
            correctAnswerText.classList.remove('hidden');

            if (userAnswer === questionData.alternativaCorreta) {
                score++;
                scoreDisplay.textContent = score;
            }

            nextButton.style.display = 'block';
        }

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        function showNextQuestion() {


            const questions = document.querySelectorAll('.question');
            questions[currentQuestionIndex].classList.remove('active');
            currentQuestionIndex++;

            if (currentQuestionIndex < questions.length) {
                questions[currentQuestionIndex].classList.add('active');
            } else {
                swal('Você completou o questionário!');
                const email = "<?php echo $_SESSION['usuario']; ?>";
                const ex_feitos = currentQuestionIndex;
                console.log(score);

                $.ajax({
                    type: 'POST',
                    url: 'update.php',
                    data: {
                        score: score,
                        ex_feitos: currentQuestionIndex,
                        email: email
                    },
                    success: function(response) {
                        swal({
                            title: "Você completou os exercícios!",
                            text: "Suas respostas foram salvas.",
                            icon: "success",
                            buttons: {
                                cancel: {
                                    text: "Fechar",
                                    visible: true,
                                    closeModal: true
                                },
                                confirm: {
                                    text: "Ver vídeo da correção",
                                    visible: true,
                                    closeModal: true
                                }
                            }
                        }).then((willConfirm) => {
                            if (willConfirm) {
                                // Quando o usuário clicar no botão "Ver vídeo da correção"
                                window.location.href = correcao.variavel;
                            } else {
                                // Quando o usuário clicar no botão "Fechar"
                                window.location.href = "selecionarEx.php";
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            mostrarButton.hidden = true;
            updiv.style.display = 'none';
            nextButton.style.display = 'none';
        }

        loadQuestions();
    </script>
</body>

</html>