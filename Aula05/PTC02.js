const tabela = document.getElementById('tabelaNotas');
const btnLinha = document.getElementById('linhaTotalizadora');
const btnColuna = document.getElementById('colunaTotalizadora');


btnLinha.onclick = function() {
    const linhas = tabela.rows;
    const tr = tabela.insertRow(-1);
    tr.classList.add('totalizadora');
    tr.insertCell(0).textContent = 'Média';

    for (let c = 1; c < linhas[2].cells.length; c++) {
        let soma = 0;
        let count = 0;
        for (let r = 2; r < linhas.length-1; r++) { 
            const valor = parseFloat(linhas[r].cells[c].textContent.replace(',', '.'));
            if (!isNaN(valor)) {
                soma += valor;
                count++;
            }
        }
        tr.insertCell(c).textContent = count ? (soma / count).toFixed(2) : '';
    }
};

btnColuna.onclick = function() {
    const linhas = tabela.rows;

    linhas[0].insertCell(-1).outerHTML = '<th class="totalizadora">Média</th>';

   
    for (let r = 2; r < linhas.length; r++) {
        let soma = 0;
        let count = 0;
        for (let c = 1; c < linhas[r].cells.length; c++) {
            const valor = parseFloat(linhas[r].cells[c].textContent.replace(',', '.'));
            if (!isNaN(valor)) {
                soma += valor;
                count++;
            }
        }
        const td = linhas[r].insertCell(-1);
        td.textContent = count ? (soma / count).toFixed(2) : '';
        td.classList.add('totalizadora');
    }
};
