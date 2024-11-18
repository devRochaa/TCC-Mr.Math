<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div id="quiz-container"></div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    function fetchImageBase64(id_imagem) {
      $.ajax({
        type: 'POST',
        url: 'api_imagem.php', // Endpoint onde o PHP irá buscar a imagem
        data: {
          id: id_imagem
        }, // Envia o ID da imagem
        dataType: 'json', // Espera uma resposta JSON
        success: function(response) {
          // Verifica se a resposta contém a base64
          if (response.imageBase64) {
            // Cria a tag de imagem no HTML
            const imageElement = document.createElement('img');
            imageElement.src = 'data:image/jpeg;base64,' + response.imageBase64;
            imageElement.alt = 'Imagem da questão';
            imageElement.classList.add('question-image'); // Classe para estilizar a imagem (opcional)

            // Adiciona a imagem ao container do quiz ou qualquer outro lugar desejado
            document.getElementById('quiz-container').appendChild(imageElement);
          } else {
            console.log('Imagem não encontrada ou não retornada corretamente.');
          }
        },
        error: function(xhr, status, error) {
          console.error('Erro ao buscar imagem:', error);
        }
      });
    }

    fetchImageBase64(38);
  </script>
</body>

</html>