<?php

    class Session {
        private $sessionID;
        private $status; //1 - Ativo, 0 - Inativo
        private $usuario;
        private $dataHoraInicio;
        private $dataHoraUltimoAcesso;

        public function __construct() {
            // Construtor vazio
            $this->iniciaSessao();
        }

        private function iniciaSessao() {
            session_start();
            if(isset($_SESSION['usuario'])) {
                //Recupera dados da sessao
                $this->dataHoraInicio = $this->recuperaDadoSessao('dataHoraInicio');
                $this->dataHoraUltimoAcesso = date('Y-m-d H:i:s');
                //Recuperar dados do usuário da sessão
                //////
            } else {
                $this->dataHoraInicio = date('Y-m-d H:i:s');
            }
            $this->status = 1; //Ativo
            $this->sessionID = session_id();
        }

        public function salvaSessao() {
            //Gravar dados da sessao antes de encerrar
            $this->gravaDadoSessao('dataHoraInicio', $this->dataHoraInicio);
            $this->gravaDadoSessao('dataHoraUltimoAcesso', $this->dataHoraUltimoAcesso);
            $this->gravaDadoSessao('usuario', $this->usuario->getUserName());  
        }

        public function encerraSessao() {
            session_unset();
            session_destroy();
        }

        public function setUsuarioSessao($usuario) {
            $this->usuario = $usuario;
        }

        public function getUsuarioSessao() {
            return $this->usuario;
        }

        public function gravaDadoSessao($chave, $valor) {
            $_SESSION[$chave] = $valor;
        }

        public function recuperaDadoSessao($chave) {
            if( isset($_SESSION[$chave])) {
                return $_SESSION[$chave];
            } else {
                return null;
            }
        }

        public function getStatus() {
            return $this->status;
        }
    }

?>