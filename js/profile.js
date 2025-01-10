function gerarMD5(texto) {
  return CryptoJS.MD5(texto).toString();
}

const senha_atual = $("#senha_atual").val();
const senha_nova = $("#senha_nova").val();
const confirmar_senha = $("#confirmar_senha").val();
const validate = () => {
  const senha_nova = $("#senha_nova").val();
  const confirmar_senha = $("#confirmar_senha").val();
  const $result = $('#result');
  $result.attr('src', '');

  if (senha_nova === confirmar_senha) {
    $result.attr('src', "img/verificado.png");

  } else {
    $result.attr('src', "img/errado.png");

  }
  return false;
}
$('#confirmar_senha').on('input', validate);


$("#trocar").click(function () {

  const senha_atual = gerarMD5($("#senha_atual").val());
  const senha_nova = $("#senha_nova").val();
  const confirmar_senha = $("#confirmar_senha").val();

  if ($("#senha_atual").val().length == 0 || $("#senha_nova").val().length == 0 || $("#confirmar_senha").val().length == 0) {
    swal("Não foi possível redefinir!", "Preencha todos os campos", "error");
    return false;
  }
  if (senha_atual != senha_real) {
    swal("Não foi possível redefinir!", "Sua senha está incorreta", "error");
    return false;
  }

  if (gerarMD5(senha_nova) === senha_atual) {
    swal("Não foi possível redefinir!", "Não é possível redefinir com a mesma senha", "error");
    return false;
  }
  if (senha_nova === confirmar_senha) {
    $.post('account_process/trocar_senha.php?senha=' + gerarMD5(senha_nova), function (response) {
      swal("Sua senha foi alterada!", response, "success"); // Exibe o alerta com a mensagem do servidor
    }).fail(function () {
      swal("Erro!", "Não foi possível alterar a senha.", "error"); // Caso a requisição falhe
    });
  } else {
    swal("Não foi possível redefinir!", "A sua confirmação de senha está diferente", "error");
    return false;

  }
});

$("#mostrar1").click(function () {
  const senha_atual = $("#senha_atual");
  const currentType = senha_atual.attr('type');
  senha_atual.attr('type', currentType === "password" ? "text" : "password");
});
$("#mostrar2").click(function () {
  const senha_nova = $("#senha_nova");
  const currentType = senha_nova.attr('type');
  senha_nova.attr('type', currentType === "password" ? "text" : "password");
});
$("#mostrar3").click(function () {
  const confirmar_senha = $("#confirmar_senha");
  const currentType = confirmar_senha.attr('type');
  confirmar_senha.attr('type', currentType === "password" ? "text" : "password");
});