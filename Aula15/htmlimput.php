<?php

    require_once 'htmlelement.php';

    class htmlinput extends htmlElement {
        private $titulo;
        private $default;
        private $senha;

        public function __construct() {
            $this->setStyle("font-color: red");
        }

       
        public function renderHtml() {
           
            return "<input ". $this->getStyle() . ">" . $this->getTitulo() . "</input>";
        }

        public function getTitulo() {
            return $this->titulo;
        }

        public function setTitulo($sTitulo) {
            $this->titulo = $sTitulo;
        }

        public function setDefault($sValorDefault) {
            $this->default = $sValorDefault;
        }

        public function setSenha($isCampoSenha) {
            $this->senha = $isCampoSenha;
        }

    }

?>