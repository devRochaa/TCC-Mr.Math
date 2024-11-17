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

    // Limpa inputs
    textInputsContainer.innerHTML = '';

    for (let i = 0; i < numberOfInputs; i++) {
      const inputGroup = document.createElement('div');
      inputGroup.className = 'input-group';

      const label = document.createElement('label');
      label.textContent = `Alternativa ${i + 1}:`;
      inputGroup.appendChild(label);

      const textInput = document.createElement('input');
      textInput.type = 'text';
      textInput.name = `alternativa_${i + 1}`;
      textInput.className = 'input-addex';
      inputGroup.appendChild(textInput);

      textInputsContainer.appendChild(inputGroup);
    }
  });
});
