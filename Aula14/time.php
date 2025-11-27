<?php
require_once "jogador.php";
class time {
    private $nome;
    private  $anofundacao;
    private  $jogadores;

      public function __construct() {
        $this->jogador = array();
     }
     public function adicionajogador($nome,$posicao,$datadenascimento){
        $jogador = new jogador ();
        $jogador ->setnome($nome);
         $jogador ->setposicao($posicao);
          $jogador ->setdatadenascimeto($datadenascimento);
          array_push($this->jogadores,$jogador);
     }
     
     public function getNome(){
         return $this->nome;  
     }
     
     public function setNome($nome){
         $this->nome = $nome;  
     }
     public function getanoFundacao(){
        return $this ->anofundacao;

     }
     public function setFundacao(){
        $this->anofundacao = $anofundacao;
     }
    
}