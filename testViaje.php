<?php
include 'Pasajero.php';
include 'ResponsableV.php';
include 'Viaje.php';

$objResponsable = new ResponsableV(546,123987,'JUAN','RODRIGUEZ');



$arregloViaje = [
    $objPasajero1 = new Pasajero('TOBIAS','PEREZ',11274963,2995879687),
    $objPasajero2 = new Pasajero('ENRIQUE','RODRIGUEZ',14684069,1164968234),
    $objPasajero3 = new Pasajero('MANUEL','CONTRERAS',17395869,2615395864),
    $objPasajero4 = new Pasajero('LAURA','LOPEZ',34660938,344985678),
    $objPasajero5 = new Pasajero('JUAN','ROMERO',30440659,2995967843),
    $objPasajero6 = new Pasajero('DANIEL','FONDACARO',27395587,1164506945),
    $objPasajero7 = new Pasajero('MALENA','DELGADO',22593330,2994079845),
    $objPasajero8 = new Pasajero('PAULA','GUERRA',19220598,26160456783)];


$objViaje = new Viaje('033DFH', 'BUENOS AIRES', 17, $arregloViaje, $objResponsable);



$strMenu = 
    "0) Ingrese '0' para salir.\n" .
    "1) Ingrese '1' para modificar código del viaje. \n" .
    "2) Ingrese '2' para modificar destino del viaje. \n" .
    "3) Ingrese '3' para modificar límite de pasajeros del viaje. \n" .
    "4) Ingrese '4' para agregar pasajero. \n" .
    "5) Ingrese '5' para modificar datos de un pasajero. \n" .
    "6) Ingrese '6' para eliminar pasajero del viaje. \n" .
    "7) Ingrese '7' para modificar la informacion del responsable del viaje. \n" .
    "8) Ingrese '8' para mostrar información del viaje y de los pasajeros. \n";

echo $strMenu;
$seleccion = trim(fgets(STDIN));
while ($seleccion != 0){
    switch ($seleccion){
        case 1:
            echo "Ingrese nuevo código de viaje: ";
            $nuevoCodigo = strtoupper(trim(fgets(STDIN)));
            $objViaje->setCodigo($nuevoCodigo);
            echo "Se ha modificado el código con éxito.\n\n";
            break;
        case 2:
            echo "Ingrese nuevo destino de viaje: ";
            $nuevoDestino = strtoupper(trim(fgets(STDIN)));
            $objViaje->setDestino($nuevoDestino);
            echo "Se ha modificado el destino con éxito.\n\n";
            break;
        case 3:
            echo "Ingrese nuevo límite de pasajeros: ";
            $nuevoLimPasajeros = trim(fgets(STDIN));
            $objViaje->setMaxPasajeros($nuevoLimPasajeros);
            echo "Se ha modificado el límite de pasajeros con éxito.\n\n";
            break;
        case 4:
            echo "Ingrese datos del pasajero a añadir: \n";
            echo "Nombre: ";
            $nombreAgregar = strtoupper(trim(fgets(STDIN)));
            echo "Apellido: ";
            $apellidoAgregar = strtoupper(trim(fgets(STDIN)));
            echo "DNI: ";
            $dniAgregar = trim(fgets(STDIN));
            echo "Telefono: ";
            $telefonoAgregar = trim(fgets(STDIN));
            $objPasajeroAgregar = new Pasajero($nombreAgregar,$apellidoAgregar,$dniAgregar,$telefonoAgregar);
            $validacion = $objViaje->agregarPasajero($objPasajeroAgregar);
            if ($validacion == false){
                echo "Se ha añadido el pasajero con éxito.\n\n";
            }
            else{
                echo "El pasajero ya se encuentra en la lista.\n\n";
            }
            break;
        case 5:
            echo "DNI del pasajero a modificar: ";
            $dniBusco = trim(fgets(STDIN));
            echo "Ingrese datos del pasajero modificados: \n";
            echo "Nombre: ";
            $nombreModif = strtoupper(trim(fgets(STDIN)));
            echo "Apellido: ";
            $apellidoModif = strtoupper(trim(fgets(STDIN)));
            echo "Telefono: ";
            $telefonoModif = trim(fgets(STDIN));
            $valMod = $objViaje->ModificarPasajero($dniBusco,$nombreModif, $apellidoModif,$telefonoModif);
            if ($valMod == true){
                echo "Se ha modificado el pasajero con éxito.\n\n";
            }
            else{
                echo "El pasajero a modificar no se encuentra en la lista.\n\n";
            }            
            break;
        case 6:
            echo "DNI del pasajero a eliminar: \n";
            $dniEliminar = trim(fgets(STDIN));
            $valBorrar = $objViaje->borrarPasajero($dniEliminar);
            if ($valBorrar == true){
                echo "Se ha eliminado el pasajero con éxito.\n\n";
            }
            else{
                echo "El pasajero a eliminar no se encuentra en la lista.\n\n";
            }
            break;
        case 7:
            $objResponsableMod = $objViaje->getObjResponsable();
            echo "Ingrese los datos a modificar del responsable del viaje: \n";
            echo "Ingrese numero de empleado: ";
            $numEmpleadoRespMod = trim(fgets(STDIN));
            $objResponsableMod->setNumEmpleado($numEmpleadoRespMod);
            echo "Ingrese numero de licencia: ";
            $numLicenciaRespMod = trim(fgets(STDIN));
            $objResponsableMod->setNumLicencia($numLicenciaRespMod);
            echo "Ingrese nombre del responsable: ";
            $nombreRespMod = strtoupper(trim(fgets(STDIN)));
            $objResponsableMod->setNombre($nombreRespMod);
            echo "Ingrese apellido del responsable: ";
            $apellidoRespMod = strtoupper(trim(fgets(STDIN)));
            $objResponsableMod->setApellido($apellidoRespMod);
            echo "Se han modificado los datos correctamente. \n\n";            
            break;
        case 8:
            echo "****DATOS DEL VIAJE****\n";
            echo $objViaje;
            break;
    }
    echo $strMenu;
    $seleccion = trim(fgets(STDIN));
}




/*
//MODIFICO DATOS PRINCIPALES DEL VIAJE:
$objViaje->setCodigo('034$$25');//Modificar código de viaje.
$objViaje->setDestino('Mendoza Capital');//Modificar destino.
$objViaje->setMaxPasajeros(10);//Modificar cantidad máxima de pasajeros.
echo $objViaje;

//MODIFICO DATOS DEL RESPONSABLE DEL VIAJE Y LOS MUESTRO:
$objResponsableMod = $objViaje->getObjResponsable();
$objResponsableMod->setNumEmpleado(300);
echo "NUMERO DE EMPLEADO MODIFICADO: " . $objResponsableMod->getNumEmpleado() . "\n";
$objResponsableMod->setNumLicencia(333444);
echo "NUMERO DE LICENCIA MODIFICADO: " . $objResponsableMod->getNumLicencia() . "\n";
$objResponsableMod->setNombre("NICOLAS");
echo "NOMBRE MODIFICADO: " . $objResponsableMod->getNombre() . "\n";
$objResponsableMod->setApellido("SORIN");
echo 'APELLIDO MODIFICADO: ' . $objResponsableMod->getApellido() . "\n\n";

//AGREGO PASAJERO Y MUESTRO LA COLECCION:
$objNewPasajero = new Pasajero('EMILIANO','PARRILLA',37000000,2996000000);
$validacion = $objViaje->agregarPasajero($objNewPasajero);
if ($validacion == false){
    echo "Se ha añadido el pasajero con éxito.\n\n";
}
else{
    echo "El pasajero ya se encuentra en la lista.\n\n";
}            
echo $objViaje->mostrarDatosPasajeros();

//MODIFICO PASAJERO Y MUESTRO LA COLECCION:
$objPasajeroCambiar = new Pasajero('PAOLA','GUERRERRO',19000000,261000000);
$valMod = $objViaje->ModificarPasajero($objPasajero8,$objPasajeroCambiar);
if ($valMod == true){
    echo "Se ha modificado el pasajero con éxito.\n\n";
}
else{
    echo "El pasajero a modificar no se encuentra en la lista.\n\n";
}
echo $objViaje->mostrarDatosPasajeros();

//ELIMINO PASAJERO Y MUESTRO LA COLECCION;
$objViaje->borrarPasajero($objPasajero4);
if ($valBorrar == true){
    echo "Se ha eliminado el pasajero con éxito.\n\n";
}
else{
    echo "El pasajero a eliminar no se encuentra en la lista.\n\n";
}              
echo $objViaje->mostrarDatosPasajeros();
*/

?>