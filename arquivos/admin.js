// public/js/admin.js
const apiBase = '../../SRC'; // admin.php está em public/html, src está em ../../src

document.getElementById('btnLogin').addEventListener('click', async () => {
  const username = document.getElementById('username').value.trim();
  const password = document.getElementById('password').value.trim();
  if (!username || !password) return alert('Preencha usuário e senha');

  const res = await fetch(`${apiBase}/teste_login.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ username, password })
  });
  const j = await res.json();
  if (j.sucesso) {
    document.getElementById('loginCard').style.display = 'none';
    document.getElementById('panel').style.display = 'block';
    carregarTudo();
  } else {
    alert(j.erro || 'Erro no login');
  }
});

document.getElementById('btnLogout').addEventListener('click', async () => {
  await fetch(`${apiBase}/logout.php`);
  location.reload();
});

async function carregarTudo() {
  await carregarPerguntas();
  await carregarSetores();
  await carregarDispositivos();
  await carregarDashboard();
}

/* Perguntas */
async function carregarPerguntas() {
  const res = await fetch(`${apiBase}/api_perguntas.php`);
  const data = await res.json();
  const cont = document.getElementById('listaPerguntas');
  cont.innerHTML = `<table>
    <thead><tr><th>ID</th><th>Pergunta</th><th>Status</th><th>Ações</th></tr></thead>
    <tbody>${data.map(p => `<tr>
      <td>${p.id_pergunta}</td>
      <td><input data-id="${p.id_pergunta}" class="txtPerg" style="width:100%" value="${escapeHtml(p.texto_pergunta)}"/></td>
      <td>
        <select data-id="${p.id_pergunta}" class="selStatus">
          <option value="ativa" ${p.status_pergunta==='ativa'?'selected':''}>ativa</option>
          <option value="inativa" ${p.status_pergunta==='inativa'?'selected':''}>inativa</option>
        </select>
      </td>
      <td>
        <button onclick="salvarPerg(${p.id_pergunta})">Salvar</button>
        <button onclick="deletarPerg(${p.id_pergunta})">Excluir</button>
      </td>
    </tr>`).join('')}</tbody></table>`;

  document.getElementById('btnCriarPergunta').onclick = async () => {
    const texto = document.getElementById('novaPergunta').value.trim();
    if (!texto) return alert('Escreva a pergunta');
    const r = await fetch(`${apiBase}/api_perguntas.php`, {
      method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify({texto})
    });
    const j = await r.json();
    if (j.sucesso) { document.getElementById('novaPergunta').value=''; carregarPerguntas(); }
    else alert(j.erro || 'Erro');
  };
}

window.salvarPerg = async function(id) {
  const texto = document.querySelector(`.txtPerg[data-id='${id}']`).value.trim();
  const status = document.querySelector(`.selStatus[data-id='${id}']`).value;
  if (!texto) return alert('Texto vazio');
  const res = await fetch(`${apiBase}/api_perguntas.php`, { method:'PUT', headers:{'Content-Type':'application/json'}, body: JSON.stringify({id, texto, status})});
  const j = await res.json();
  if (j.sucesso) carregarPerguntas(); else alert(j.erro || 'erro');
};

window.deletarPerg = async function(id) {
  if (!confirm('Confirmar exclusão?')) return;
  const res = await fetch(`${apiBase}/api_perguntas.php`, { method:'DELETE', headers:{'Content-Type':'application/json'}, body: JSON.stringify({id})});
  const j = await res.json();
  if (j.sucesso) carregarPerguntas(); else alert(j.erro || j.mensagem || 'erro');
};

/* Setores */
async function carregarSetores() {
  const res = await fetch(`${apiBase}/api_setores.php`);
  const data = await res.json();
  document.getElementById('listaSetores').innerHTML = data.map(s=>`<div>${s.id_setor} - ${escapeHtml(s.nome_setor)}</div>`).join('');
  document.getElementById('btnCriarSetor').onclick = async () => {
    const nome = document.getElementById('novoSetor').value.trim();
    if (!nome) return alert('Nome do setor');
    await fetch(`${apiBase}/api_setores.php`, { method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({nome})});
    document.getElementById('novoSetor').value=''; carregarSetores();
    carregarDispositivos();
  };
}

/* Dispositivos */
async function carregarDispositivos() {
  const res = await fetch(`${apiBase}/api_dispositivos.php`);
  const data = await res.json();
  document.getElementById('listaDispositivos').innerHTML = data.map(d=>`<div>${d.id_dispositivo} - ${escapeHtml(d.nome_dispositivo)} (status: ${d.status_dispositivo || '—'})</div>`).join('');
  document.getElementById('btnCriarDispositivo').onclick = async () => {
    const nome = document.getElementById('novoDispositivo').value.trim();
    if (!nome) return alert('Nome do dispositivo');
    await fetch(`${apiBase}/api_dispositivos.php`, { method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({nome, status:'ativo'})});
    document.getElementById('novoDispositivo').value=''; carregarDispositivos();
  };
}

/* Dashboard */
async function carregarDashboard() {
  const res = await fetch(`${apiBase}/api_dashboard.php`);
  const j = await res.json();
  const d = document.getElementById('dashboard');
  d.innerHTML = `<h4>Média por Pergunta</h4>
    <table><thead><tr><th>ID</th><th>Pergunta</th><th>Média</th><th>Total</th></tr></thead>
    <tbody>${j.por_pergunta.map(r=>`<tr><td>${r.id_pergunta}</td><td>${escapeHtml(r.texto_pergunta)}</td><td>${r.media}</td><td>${r.total}</td></tr>`).join('')}</tbody></table>
    <h4>Média por Setor</h4>
    <table><thead><tr><th>ID</th><th>Setor</th><th>Média</th><th>Total</th></tr></thead>
    <tbody>${j.por_setor.map(r=>`<tr><td>${r.id_setor}</td><td>${escapeHtml(r.nome_setor)}</td><td>${r.media}</td><td>${r.total}</td></tr>`).join('')}</tbody></table>
  `;
}

/* util */
function escapeHtml(s){ return String(s||'').replace(/[&<>"']/g, function(m){return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];}); }
