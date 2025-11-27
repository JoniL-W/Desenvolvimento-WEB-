<?php
     
    require_once "pessoa.php";
    require_once "contato.php";

    
    $pessoa = new Pessoa();
    $pessoa->setNome("Cleber");
    $pessoa->setSobreNome("Nardelli");
    $dataNascimento = new DateTime("1981-11-07");
    $pessoa->setDataNascimento($dataNascimento);

    $contatoEmail = new Contato();
    $contatoEmail->setTipo(1); 
    $contatoEmail->setNome("Email");
    $contatoEmail->setValor("cleber.nardelli@example.com");
    $pessoa->AddContato($contatoEmail);

    $contatoTelefone = new Contato();
    $contatoTelefone->setTipo(2); 
    $contatoTelefone->setNome("Telefone");
    $contatoTelefone->setValor("+55 11 91234-5678");
    $pessoa->AddContato($contatoTelefone);

    echo "Pessoa: ".$pessoa->getNomeCompleto()."<br>";
    echo "Idade: ".$pessoa->getIdade()." anos<br>";

    var_dump($pessoa->getContatoPeloTipo(1)); 
?>