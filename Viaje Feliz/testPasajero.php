<?php

include 'Pasajero.php';

$objPasajero = new Pasajero('Emiliano','Parrilla',15000000,2994000000);

echo $objPasajero;

//EJECUTO METODOS DE ACCESO 'get' y 'set':
$objPasajero->setNombre("Dario");
echo 'NOMBRE MODIFICADO: ' . $objPasajero->getNombre() . "\n";
$objPasajero->setApellido("Lopez");
echo 'APELLIDO MODIFICADO: ' . $objPasajero->getApellido() . "\n";
$objPasajero->setDoc(14000000);
echo 'DOCUMENTO MODIFICADO: ' . $objPasajero->getDoc() . "\n";
$objPasajero->setTelefono(1155555555);
echo 'TELEFONO MODIFICADO: ' . $objPasajero->getTelefono() . "\n";

