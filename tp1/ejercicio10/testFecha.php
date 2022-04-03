<?php
include "Fecha.php";
$objFecha1 = new Fecha(15,4,2000);
echo "La fecha abreviada: \n" . $objFecha1->fechaAbreviada();
echo "Fecha extendida: \n" . $objFecha1->fechaExtendida();
echo "Incremento de un día: \n" . $objFecha1->incrementaUnDia();
echo $objFecha1->esBisiesto();
echo "Incremento de varios días: \n" . $objFecha1->incremento(35, array(20,3,2001));
?>