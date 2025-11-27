<?php

    class Pessoa {
        private $nome;
        private $sobreNome;
        private $tipo;
        private $dataNascimento;
        private $dataInstancia;
        //Lista de Contatos da Pessoa
        private $contatos = array();

        public function __construct() {
            $this->tipo = 1;
            $this->dataInstancia = new DateTime();
        }

        public function getDataInstancia() {
            return $this->dataInstancia->format('d/m/Y H:i:s');
        }

        public function getIdade() {
            $dataAtual = new DateTime();
            $idade = $dataAtual->diff($this->dataNascimento);
            return $idade->y;
        }

        public function AddContato($contato) {
            //Adicionar um contato na lista de contatos
            array_push($this->contatos, $contato);
        }

        public function getContatoPeloTipo($tipo) {
           
            foreach ($this->contatos as $contato) {
                if ($contato->getTipo() == $tipo) {
                    return $contato;
                }
            }
            return null;
        }

        public function getNomeCompleto() {
            return $this->nome . " " . $this->sobreNome;
        }
        public function getNome() {
            return $this->nome;
        }
        public function getSobreNome() {
            return $this->sobreNome;
        }
        public function setNome($nome) {
            $this->nome = $nome;
        }
        public function setSobreNome($sobreNome) {
            $this->sobreNome = $sobreNome;
        }
        public function getDataNascimento() {
            return $this->dataNascimento;
        }   
        public function setDataNascimento($dataNascimento) {
            $this->dataNascimento = $dataNascimento;
        }
    }

?>