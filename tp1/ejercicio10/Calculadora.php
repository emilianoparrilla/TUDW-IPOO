<?php
class Calculadora{
    private $valor_a;
    private $valor_b;
    public function __construct ($a, $b){
        $this->valor_a = $a;
        $this->valor_b = $b;
    }
    public function getValor_a(){
        return $this->valor_a;
    }
    public function getValor_b(){
        return $this->valor_b;
    }
    public function setValor_a($a){
        $this->valor_a=$a;
    }
    public function setValor_b($b){
        $this->valor_b=$b;
    }
    public function suma(){
        $laSuma = $this->getValor_a() + $this->getValor_b();
        return $laSuma;
    }
    public function resta(){
        $laResta = $this->getValor_a() - $this->getValor_b();
        return $laResta;
    }
    public function multiplicacion(){
        $elProducto = $this->getValor_a() * $this->getValor_b();
        return $elProducto;
    }
    public function division(){
        $elCociente = $this->getValor_a() / $this->getValor_b();
        return $elCociente;
    }
    public function __toString(){
        return "Valor a: " . $this->getValor_a() . " ; Valor b: " . $this->getValor_b() . "\n";
    }
    public function __destruct(){
		echo $this . " instancia destruida, no hay referencias a este objeto \n";
	}
}
?>
