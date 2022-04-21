<?php

include 'ResponsableV.php';

$objResponsable = new ResponsableV(546,123987,'Juan','Rodriguez');

echo $objResponsable;

//EJECUTO METODOS 'get' Y 'set':
$objResponsable->setNumEmpleado(300);
echo "NUMERO DE EMPLEADO MODIFICADO: " . $objResponsable->getNumEmpleado() . "\n";
$objResponsable->setNumLicencia(333444);
echo "NUMERO DE LICENCIA MODIFICADO: " . $objResponsable->getNumLicencia() . "\n";
$objResponsable->setNombre("Nicolas");
echo "NOMBRE MODIFICADO: " . $objResponsable->getNombre() . "\n";
$objResponsable->setApellido("Sorin");
echo 'APELLIDO MODIFICADO: ' . $objResponsable->getApellido() . "\n\n";
?>
