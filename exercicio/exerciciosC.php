<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Exercícios</title>
    <link rel="stylesheet" href="../css/navbar.css?=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/exercicios.css?=<?php echo time(); ?>">
    
</head>
<body>
    <?php include("../navbar.php");?>
    <h1 class="main-title">Exercícios</h1>
    <div id="quiz-container"></div>
    <div>
        <h2>Acertos: <span id="score">0</span></h2>
    </div>

    <button id="next-question" class="next-button" onclick="showNextQuestion()">Próxima Questão</button>

    <script>
        let score = 0;
        let currentQuestionIndex = 0;

        const quizContainer = document.getElementById('quiz-container');
        const scoreDisplay = document.getElementById('score');
        const nextButton = document.getElementById('next-question');

        // Carrega as questões de um arquivo JSON
        async function loadQuestions() {
            try {
                const response = await fetch('api.php');
                const quizData = await response.json();
                loadQuiz(quizData);
            } catch (error) {
                console.error('Erro ao carregar as questões:', error);
            }
        }

        // Função para carregar as questões no HTML
        function loadQuiz(quizData) {
            quizData.forEach((questionData, index) => {
                const questionElement = document.createElement('div');
                questionElement.classList.add('question');
                if (index === 0) questionElement.classList.add('active');

                const questionTitle = document.createElement('h3');
                questionTitle.classList.add('question-title');
                questionTitle.textContent = `${index + 1}. ${questionData.questao}`;
                questionElement.appendChild(questionTitle);

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

        // Função para verificar a resposta
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

            inputs.forEach(input => {
                const label = input.nextElementSibling;

                if (input.value === questionData.alternativaCorreta) {
                    label.classList.add('correct');
                } else if (input.checked && input.value !== questionData.alternativaCorreta) {
                    label.classList.add('wrong');
                }

                // Desmarca o input visualmente (remover o "checked" sem remover a cor)
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
                alert('Você completou o questionário!');
            }

            nextButton.style.display = 'none';
        }

        // Iniciar carregamento das questões
        loadQuestions();
    </script>
</body>
</html>
