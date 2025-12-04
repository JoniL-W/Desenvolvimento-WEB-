btnDashboard.addEventListener('click', () => {
  window.location.href = "../../SRC/dashboard.php";
});

document.addEventListener('DOMContentLoaded', () => {
  const listaSetores = [
    { id: 1, nome: 'Atendimento' },
    { id: 2, nome: 'Financeiro' }
  ];

  const listaDispositivos = [
    { id: 1, nome: 'Desktop' },
    { id: 2, nome: 'Mobile' }
  ];

  const telaLogin = document.getElementById('loginScreen');
  const painelAdmin = document.getElementById('adminPanel');
  const botaoLogin = document.getElementById('btnLogin');
  const botaoSair = document.getElementById('btnLogout');
  const botaoDashboard = document.getElementById('btnToDashboard');
  const selSetor = document.getElementById('selSetor');
  const selDispositivo = document.getElementById('selDisp');
  const botaoAdicionarSetor = document.getElementById('addSetor');
  const botaoAdicionarDispositivo = document.getElementById('addDisp');
  const txtPergunta = document.getElementById('txtPergunta');
  const idPergunta = document.getElementById('idPergunta');
  const selAcao = document.getElementById('selAcao');
  const btnEnviar = document.getElementById('btnEnviar');
  const previewCard = document.getElementById('previewCard');
  const historyList = document.getElementById('historyList');
  const toast = document.getElementById('toast');


  function mostrarToast(mensagem, tipo = 'ok') {
    if (!toast) return;
    toast.textContent = mensagem;
    toast.className = 'toast visible ' + (tipo === 'ok' ? 'ok' : 'err');
    setTimeout(() => {
      toast.className = 'toast hidden';
    }, 2800);
  }

  function preencherSelects() {
    if (selSetor) {
      selSetor.innerHTML = '<option value="">-- selecione --</option>';
      listaSetores.forEach(s => {
        const opt = document.createElement('option');
        opt.value = s.id;
        opt.textContent = s.nome;
        selSetor.appendChild(opt);
      });
    }

    if (selDispositivo) {
      selDispositivo.innerHTML = '<option value="">-- selecione --</option>';
      listaDispositivos.forEach(d => {
        const opt = document.createElement('option');
        opt.value = d.id;
        opt.textContent = d.nome;
        selDispositivo.appendChild(opt);
      });
    }
  }

  function adicionarHistorico(texto) {
    if (!historyList) return;
    const li = document.createElement('li');
    li.textContent = `[${new Date().toLocaleTimeString()}] ${texto}`;
    historyList.prepend(li);
  }

  function atualizarPreview() {
    if (!txtPergunta || !selSetor || !selDispositivo || !idPergunta || !selAcao || !previewCard) return;

    const pergunta = txtPergunta.value.trim();
    const setorTexto = selSetor.selectedOptions[0] ? selSetor.selectedOptions[0].text : '';
    const dispositivoTexto = selDispositivo.selectedOptions[0] ? selDispositivo.selectedOptions[0].text : '';
    const id = idPergunta.value.trim();
    const acao = selAcao.value;

    if (!pergunta && acao !== 'remove') {
      previewCard.innerHTML = '<p class="preview-meta">Preencha a pergunta para ver o preview.</p>';
      return;
    }

    const html = [];
    html.push('<div class="preview-head"><strong>Ação:</strong> ' + acao.toUpperCase() + '</div>');
    if (id) html.push('<div class="preview-id"><strong>ID:</strong> ' + id + '</div>');
    if (pergunta) html.push('<div class="preview-question">“' + pergunta.replace(/\n/g, '<br>') + '”</div>');
    if (setorTexto) html.push('<div class="preview-rel"><strong>Setor:</strong> ' + setorTexto + '</div>');
    if (dispositivoTexto) html.push('<div class="preview-rel"><strong>Dispositivo:</strong> ' + dispositivoTexto + '</div>');

    previewCard.innerHTML = html.join('');
  }

  if (botaoLogin) {
    botaoLogin.addEventListener('click', () => {
      const usuario = document.getElementById('loginUser')?.value.trim();
      const senha = document.getElementById('loginPass')?.value.trim();

      if (usuario === 'admin' && senha === '1234') {
        telaLogin?.classList.add('hidden');
        painelAdmin?.classList.remove('hidden');
        painelAdmin?.removeAttribute('aria-hidden');
        preencherSelects();
        mostrarToast('Login bem sucedido');
      } else {
        mostrarToast('Usuário ou senha incorretos', 'err');
      }
    });
  }

  if (botaoSair) {
    botaoSair.addEventListener('click', () => {
      painelAdmin?.classList.add('hidden');
      painelAdmin?.setAttribute('aria-hidden', 'true');
      telaLogin?.classList.remove('hidden');
      mostrarToast('Você saiu');
    });
  }

  if (botaoDashboard) {
    botaoDashboard.addEventListener('click', () => {
      mostrarToast('Abrindo dashboard (simulado)');
    });
  }

  if (botaoAdicionarSetor) {
    botaoAdicionarSetor.addEventListener('click', () => {
      const nome = prompt('Nome do novo setor:');
      if (nome && nome.trim()) {
        const id = Date.now();
        listaSetores.push({ id, nome: nome.trim() });
        preencherSelects();
        if (selSetor) selSetor.value = id;
        mostrarToast('Setor adicionado');
        atualizarPreview();
      }
    });
  }

  if (botaoAdicionarDispositivo) {
    botaoAdicionarDispositivo.addEventListener('click', () => {
      const nome = prompt('Nome do novo dispositivo:');
      if (nome && nome.trim()) {
        const id = Date.now();
        listaDispositivos.push({ id, nome: nome.trim() });
        preencherSelects();
        if (selDispositivo) selDispositivo.value = id;
        mostrarToast('Dispositivo adicionado');
        atualizarPreview();
      }
    });
  }

  ['input', 'change'].forEach(ev => {
    if (txtPergunta) txtPergunta.addEventListener(ev, atualizarPreview);
    if (selSetor) selSetor.addEventListener(ev, atualizarPreview);
    if (selDispositivo) selDispositivo.addEventListener(ev, atualizarPreview);
    if (idPergunta) idPergunta.addEventListener(ev, atualizarPreview);
    if (selAcao) selAcao.addEventListener(ev, atualizarPreview);
  });

  if (btnEnviar) {
    btnEnviar.addEventListener('click', async () => {
      if (!txtPergunta || !selSetor || !selDispositivo || !idPergunta || !selAcao) return;

      const acao = selAcao.value;
      const texto = txtPergunta.value.trim();
      const setor = selSetor.value;
      const dispositivo = selDispositivo.value;
      const id = idPergunta.value.trim();

      if (acao === 'create' && texto.length < 5) {
        mostrarToast('A pergunta deve ter pelo menos 5 caracteres', 'err');
        return;
      }

      if ((acao === 'update' || acao === 'remove') && !id) {
        mostrarToast('Informe o ID para atualizar ou remover', 'err');
        return;
      }

      try {
        const resposta = await fetch('../../SRC/perguntas_crud.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ acao, id: id || null, texto })
        });
        const json = await resposta.json();

        if (json.erro) {
          mostrarToast(json.erro, 'err');
          return;
        }

        mostrarToast(json.mensagem);
        adicionarHistorico(`${json.mensagem} — ${texto.slice(0, 80)}`);

        if (acao === 'create' && json.id) idPergunta.value = json.id;
        if (acao === 'remove') {
          txtPergunta.value = '';
          idPergunta.value = '';
          selSetor.value = '';
          selDispositivo.value = '';
        }

        atualizarPreview();
      } catch (err) {
        mostrarToast('Erro ao conectar com o servidor', 'err');
      }
    });
  }
});
