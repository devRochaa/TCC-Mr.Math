document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('fileInput');
    const toggleButton = document.getElementById('toggleButton');

    toggleButton.addEventListener('click', function () {
        if (fileInput.disabled) {
            fileInput.disabled = false;
            toggleButton.textContent = 'Desativar Envio de Arquivos';
        } else {
            fileInput.disabled = true;
            toggleButton.textContent = 'Ativar Envio de Arquivos';
        }
    });
});

function getLetter(index) {
    // Converte um índice numérico para a letra correspondente do alfabeto (A, B, C, ...)
    const charCode = 'A'.charCodeAt(0) + index;
    return String.fromCharCode(charCode);
}

document.getElementById('numberInput').addEventListener('input', function () {
    const numberInput = document.getElementById('numberInput');
    const textInputsContainer = document.getElementById('textInputsContainer');
    const numberOfInputs = parseInt(numberInput.value) || 0;

    // Limpa os inputs de texto existentes
    textInputsContainer.innerHTML = '';


    // Adiciona a quantidade de inputs de texto de acordo com o valor do input de número
    for (let i = 0; i < numberOfInputs; i++) {
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group';

        const label = document.createElement('label');
        label.textContent = `${getLetter(i)}: `;
        inputGroup.appendChild(label);

        const textInput = document.createElement('input');
        textInput.type = 'text';
        textInput.name = `${getLetter(i)}`;
        inputGroup.appendChild(textInput);

        textInputsContainer.appendChild(inputGroup);
    }
});
