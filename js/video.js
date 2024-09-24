function trocarvideo() {
  var elements = document.getElementsByClassName('thumb');
  for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', function (e) {
      var codigo = e.currentTarget.id;
      document.getElementById("iframe").src = 'https://www.youtube.com/embed/' + codigo;

    });
  }
}

trocarvideo(); // Chama a função para adicionar os event listeners