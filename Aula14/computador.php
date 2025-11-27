<?php

class computador
{

    private $estado;

    public function ligar()
    {
        if ($this->getestado() == 'ligado') {
            return false;
        }
    }
    public function ligar()
    {
        $this->estado = "ligar";
        return "ligado";
    }

    public function desligar()
    {
        $this->estado = "desligar";
        return "desligado";
    }
    public function getestado()
    {
        return $this->estado;
    }
}

?>