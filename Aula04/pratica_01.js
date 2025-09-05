const botao = document.getElementById('botao_login');

botao.addEventListener('click' , ()=>{
    const usuario = document.getElementById('usuario').value;
    const senha = document.getElementById('pass').value;

  if (usuario === 'user' && senha === 'pass') {
    alert('Login Ok');
  } else {
        const usuario = document.getElementById('usuario').value;
        const senha = document.getElementById('pass').classList.add();
  }
})
