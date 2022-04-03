<?php
include 'Cuadrado.php';
$punto1 = ['x'=> 1, 'y'=> 1];
$punto2 = ['x'=> 1, 'y'=> 5];
$punto3 = ['x'=> 5, 'y'=> 5];
$punto4 = ['x'=> 5, 'y'=> 1];
$des = ['x'=> 3, 'y'=> 3];
$objCuadrado = new Cuadrado($punto1, $punto2, $punto3, $punto4);
echo "área: " . $objCuadrado->area() . "\n";
$objCuadrado->desplazar($des);
echo "Cuadrado desplazado: \n" . $objCuadrado;
$objCuadrado->aumentarTamaño(5);
echo "Cuadrado aumentado: \n" . $objCuadrado;