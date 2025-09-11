
const input1 = document.querySelector('input:nth-of-type(1)');
const input2 = document.querySelector('input:nth-of-type(2)');
const resultadoDiv = document.querySelector('.resultado');
const botaoIgual = document.querySelector('.igual');

let resultado = 0;
let operacao = ""; 


function somar() {
  operacao = "somar";
}

function subtrair() {
  operacao = "subtrair";
}

function multiplicar() {
  operacao = "multiplicar";
}

function dividir() {
  operacao = "dividir";
}



document.querySelector('.soma').onclick = somar;
document.querySelector('.sub').onclick = subtrair;
document.querySelector('.mul').onclick = multiplicar;
document.querySelector('.div').onclick = dividir;



botaoIgual.onclick = function() {
  const num1 = parseFloat(input1.value);
  const num2 = parseFloat(input2.value);

  if (operacao === "somar") resultado = num1 + num2;
  if (operacao === "subtrair") resultado = num1 - num2;
  if (operacao === "multiplicar") resultado = num1 * num2;
  if (operacao === "dividir") resultado = num2 === 0 ? "Erro: divisão por zero" : num1 / num2;

  resultadoDiv.textContent = resultado;

 resultadoDiv.classList.remove('negativo','positivo','igual0')

  if (resultado < 0) {
    resultadoDiv.classList.add('negativo')
  }else if (resultado > 0){
    resultadoDiv.classList.add('positivo')
  }else if (resultado === 0){
    resultadoDiv.classList.add('igual0')
  }
};
