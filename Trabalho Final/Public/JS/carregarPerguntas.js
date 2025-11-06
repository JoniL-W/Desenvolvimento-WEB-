document.addEventListener("DOMContentLoaded", async () => {
  const container = document.getElementById("carrossel");
  let perguntas = [];
  let indiceAtual = 0;
  const respostas = [];

  try {
    const response = await fetch("../../src/perguntas.php");
    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
    perguntas = await response.json();

    if (!perguntas || perguntas.length === 0) {
      container.innerHTML = "<p>Nenhuma pergunta encontrada.</p>";
      return;
    }

    exibirPergunta();
  } catch (error) {
    container.innerHTML = `<p>Erro ao carregar perguntas: ${error.message}</p>`;
    console.error(error);
  }

  function exibirPergunta() {
    const p = perguntas[indiceAtual];
    container.innerHTML = `
      <h2>${p.texto_pergunta}</h2>
      <div class="opcoes">
        ${[...Array(11).keys()].map(i => `<button class="opcao" data-valor="${i}">${i}</button>`).join("")}
      </div>
      <textarea id="feedback" placeholder="Deixe sua observação (opcional)"></textarea>
      <div class="navegacao">
        <button id="voltar" ${indiceAtual === 0 ? "disabled" : ""}>← Voltar</button>
        <button id="proxima">${indiceAtual === perguntas.length - 1 ? "Enviar respostas →" : "Próxima →"}</button>
      </div>
      
    `;

    const botoes = document.querySelectorAll(".opcao");
    botoes.forEach(btn => {
      btn.addEventListener("click", () => {
        botoes.forEach(b => b.classList.remove("selecionado"));
        btn.classList.add("selecionado");
      });
    });

    document.getElementById("voltar").addEventListener("click", () => {
      if (indiceAtual > 0) {
        indiceAtual--;
        exibirPergunta();
      }
    });

    document.getElementById("proxima").addEventListener("click", async () => {
      const selecionado = document.querySelector(".opcao.selecionado");
      if (!selecionado) {
        alert("Selecione uma nota antes de continuar.");
        return;
      }

      respostas[indiceAtual] = {
        id_pergunta: p.id_pergunta,
        resposta: parseInt(selecionado.dataset.valor),
        feedback: document.getElementById("feedback").value,
        id_setor: 2,
        id_dispositivo: 1
      };

      if (indiceAtual < perguntas.length - 1) {
        indiceAtual++;
        exibirPergunta();
      } else {
        try {
          const envio = await fetch("../../src/respostas.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(respostas)
          });
          const resultado = await envio.json();

          if (resultado.sucesso) {
            container.innerHTML = `
              <h2>O Estabelecimento agradece sua resposta e ela é muito 
                importante para nós, pois nos ajuda a melhorar continuamente nossos serviços.</h2>
              <button id="refazer" style="margin-top:20px; padding:10px 20px; font-size:16px; cursor:pointer;">
                Refazer Avaliação
              </button>
            `;
          
            // Evento para voltar à primeira pergunta
            document.getElementById("refazer").addEventListener("click", () => {
              indiceAtual = 0;
              respostas.length = 0; // limpa respostas anteriores
              exibirPergunta();      // mostra a primeira pergunta
            });
          }else {
            container.innerHTML = `<p>Erro ao enviar respostas: ${resultado.erro || ""}</p>`;
          }
        } catch (err) {
          container.innerHTML = "<p>Erro ao enviar respostas.</p>";
          console.error(err);
        }
      }
    });
  }
});
