let palavroes = [];

// Carregar o arquivo JSON contendo as palavras
fetch('../js/palavras_negativas.json')
  .then(response => response.json())
  .then(data => {
    palavroes = data.palavroes; // Agora as palavras estão disponíveis
  });


function verificarPalavroes(texto) {
  // Converte o texto para minúsculas e remove espaços extras
  const textoNormalizado = texto.toLowerCase().trim();

  // Verifica se o texto contém algum palavrão
  for (let palavra of palavroes) {
    if (textoNormalizado.includes(palavra)) {
      console.log("Palavrão detectado: " + palavra);
      return false;
    }
  }

  console.log("Texto livre de palavrões");
  return true;
}

const validateEmail = (email) => {
  return /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email);
};

const validate = () => {
  const $result = $('#result');
  const email = $('#email').val();
  $result.attr('src', '');

  if (validateEmail(email)) {
    $result.attr('src', "../img/verificado.png");
    console.log("valido");
  } else {
    $result.attr('src', "../img/errado.png");
    console.log("invalido");
  }
  return false;
}
$('#email').on('input', validate);

$("#cadastrar").click(function () {
  const email = $("#email").val();
  //verificar se todos os campos do formulário foram preenchidoss
  switch (true) {

    case $("#nome").val().length < 3:
      swal("Nome inválido!", "Seu nome deve ter no mínimo 3 caracteres", "error");
      break;

    case verificarPalavroes($("#nome").val()) === false:
      swal("Nome inválido!", "Cuidado com o que você escreve", "error");
      break;

    case $("#sobrenome").val().length < 2:
      swal("Sobrenome inválido!", "Insira um sobrenome válido", "error");
      break;
    
    case verificarPalavroes($("#sobrenome").val()) === false:
      swal("Sobrenome inválido!", "Cuidado com o que você escreve", "error");
    break;

    case !validateEmail(email):
      swal("E-mail inválido!", "Insira um e-mail válido", "error");
      break;

    case $("#senha").val().length < 8:
      swal("Senha inválida!", "Sua senha deve ter no mínimo 8 caracteres", "error");
      break;

    default:
      var nome = $("#nome").val();
      var sobrenome = $("#sobrenome").val();
      var senha = $("#senha").val();

      $("#formulario").css("display", "none");
      $("#h1").css("display", "none");
      $("#carregando").html("<img src='../img/carregar.gif' width='30%'>");

      $.post("cadastro.php?nome=" + nome + "&sobrenome=" + sobrenome + "&email=" + email + "&senha=" + senha, function (include_cadastro) {

        $("#processa_form").html(include_cadastro);

      });
  }
});
