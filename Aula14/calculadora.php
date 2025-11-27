<?php 

class calculadora { 

    private $numero1;
    private $numero2;

    public function adicao($valor1,$valor2){
        return $this -> numero1 + $this ->numero2;
}

  public function subtracao($valor1,$valor2){
        return $this -> numero1 - $this ->numero2;
}

 public function divisao($valor1,$valor2){
        return $this -> numero1 / $this ->numero2;
}

 public function multiplicacao($valor1,$valor2){
        return $this -> numero1 * $this ->numero2;
}
}
?>