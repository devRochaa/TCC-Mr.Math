document.addEventListener('DOMContentLoaded', function () {
  const fileInput = document.getElementById('fileInput');
  const toggleButton = document.getElementById('toggleButton');
  const numberInput = document.getElementById('numberInput');
  const textInputsContainer = document.getElementById('textInputsContainer');

  toggleButton.addEventListener('click', function () {
    fileInput.disabled = !fileInput.disabled;
    toggleButton.textContent = fileInput.disabled
      ? 'Ativar Envio de Arquivos'
      : 'Desativar Envio de Arquivos';
  });

  numberInput.addEventListener('input', function () {
    const numberOfInputs = parseInt(numberInput.value) || 0;

    // Limpa os inputs existentes
    textInputsContainer.innerHTML = '';

    // Define as letras do alfabeto para as alternativas
    const letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];  // Você pode estender conforme necessário

    for (let i = 0; i < numberOfInputs; i++) {
      // Cria um grupo de inputs
      const inputGroup = document.createElement('div');
      inputGroup.className = 'input-group';

      // Cria um rótulo para a alternativa
      const label = document.createElement('label');
      label.textContent = `Alternativa ${letras[i]}:`;  // Usando as letras
      inputGroup.appendChild(label);

      // Cria o input de texto
      const textInput = document.createElement('input');
      textInput.type = 'text';
      textInput.name = letras[i];  // Usando a letra como nome
      textInput.className = 'input-addex';
      inputGroup.appendChild(textInput);

      // Adiciona o grupo de inputs ao contêiner
      textInputsContainer.appendChild(inputGroup);
    }
  });
});
