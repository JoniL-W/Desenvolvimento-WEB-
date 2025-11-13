document.addEventListener("DOMContentLoaded", async () => {
  const container = document.getElementById("carrossel");
  let perguntas = [];
  let indiceAtual = 0;
  const respostas = [];

  try {
    const response = await fetch("../../SRC/perguntas.php"); 
    perguntas = await response.json();

    if (!perguntas || perguntas.length === 0) {
      container.innerHTML = "<p>Nenhuma pergunta encontrada.</p>";
      return;
    }

    exibirPergunta();
  } catch (error) {
    container.innerHTML = "<p>Erro ao carregar perguntas.</p>";
    console.error(error);
  }

  function exibirPergunta() {
    if (indiceAtual === perguntas.length) {
      exibirTelaFinal();
      return;
    }

    const p = perguntas[indiceAtual];
    container.innerHTML = `
      <h2 class="perguntas">${p.texto_pergunta}</h2>
      <div class="opcoes">
        ${[...Array(11).keys()]
          .map(i => `<button class="opcao" data-valor="${i}">${i}</button>`)
          .join("")}
      </div>
      <div class="navegacao">
        <button class="voltar" id="voltar" ${indiceAtual === 0 ? "disabled" : ""}>← Voltar</button>
        <button class="proxima" id="proxima">Próxima →</button>
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

    document.getElementById("proxima").addEventListener("click", () => {
      const selecionado = document.querySelector(".opcao.selecionado");
      if (!selecionado) {
        alert("Por favor, selecione uma nota antes de continuar.");
        return;
      }

      respostas[indiceAtual] = {
        id_pergunta: p.id_pergunta,
        resposta: parseInt(selecionado.dataset.valor),
        feedback: null, 
        id_setor: 1,
        id_dispositivo: 1
      };

      indiceAtual++;
      exibirPergunta();
    });
  }

  function exibirTelaFinal() {
    container.innerHTML = `
      <h2 class="perguntas" >Deseja deixar alguma observação sobre sua experiência?</h2>
      <textarea id="feedback" placeholder="Digite aqui sua observação (opcional)..."></textarea>
      <div class="navegacao">
        <button class="volt" id="voltar">← Voltar</button>
        <button class="env_resp" id="enviar">Enviar →</button>
      </div>
    `;

    document.getElementById("voltar").addEventListener("click", () => {
      indiceAtual--;
      exibirPergunta();
    });

    document.getElementById("enviar").addEventListener("click", async () => {
      const textoFeedback = document.getElementById("feedback").value;
      if (respostas.length > 0) {
        respostas[respostas.length - 1].feedback = textoFeedback || null;
      }

      try {
        const envio = await fetch("../../SRC/respostas.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(respostas)
        });

        const resultado = await envio.json();

        if (resultado.sucesso) {
          container.innerHTML = `
            <h2 class="perguntas">O Estabelecimento agradece sua resposta e ela é muito importante para nós, pois nos ajuda a melhorar continuamente nossos serviços.</h2>
            <button class="voltar_inicio"  id="refazer">
              Voltar ao início
            </button>
          `;

          document.getElementById("refazer").addEventListener("click", () => {
            indiceAtual = 0;
            respostas.length = 0;
            exibirPergunta();
          });
        } else {
          container.innerHTML = `<p>Erro ao enviar respostas: ${resultado.erro || ""}</p>`;
        }
      } catch (err) {
        container.innerHTML = "<p>Erro ao enviar respostas.</p>";
        console.error(err);
      }
    });
  }
});