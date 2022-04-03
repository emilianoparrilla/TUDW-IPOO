<?php
include "Reloj.php";
$objReloj = new Reloj(23,59,00);
//echo $objReloj . "\n";
echo $objReloj->incremento();
$objReloj->puesta_a_cero();
?>
