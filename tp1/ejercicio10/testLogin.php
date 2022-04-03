<?php
include 'Login.php';
$objLogin1 = new Login("Emiliano", "emi1993", "Tu nombre más tu año de nacimiento", array("emi1234", "parri1993", "&emiparrilla", "&p1a2r3r4i5"));
echo $objLogin1;
//echo "Validación contraseña: \n" . $objLogin1->validar("emi1234");
echo "Cambio de contraseña: \n" . $objLogin1->cambiarContrasenia("&parrilla28");
//echo "Olvidé mi contraseña: \n" . $objLogin1->recordar("Emiliano");
