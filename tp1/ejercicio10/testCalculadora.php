<?php

include 'Calculadora.php';
$calculo1 = new Calculadora (3,4);
//echo $calculo1($this->getValor_a);
//echo $calculo1($this->getValor_b);

echo "Ingrese 1 para suma, 2 para resta, 3 para multiplicar o 4 para dividir: ";
$seleccion = trim(fgets(STDIN));
switch ($seleccion){
    case 1:
        echo "El resultado de la suma: " . $calculo1->suma() . "\n";
        break;
    case 2:
        echo "El resultado de la resta: " . $calculo1->resta() . "\n";
        break;
    case 3:
        echo "El resultado de la multiplicación: " . $calculo1->multiplicacion() . "\n";
        break;
    case 4:
        echo "El resultado de la división: " . $calculo1->division() . "\n";
        break;
}

?>