<?php
include 'Pasajero.php';
include 'ResponsableV.php';
include 'Viaje.php';
include 'ViajeTerrestre.php';
include 'ViajeAereo.php';

$objResponsableT = new ResponsableV(100,123456,'JUAN','RODRIGUEZ');
$objResponsableA = new ResponsableV(200,123456,'RODRIGO','ZAPATA');

$arregloViaje1 = [
    $objPasajero1 = new Pasajero('TOBIAS','PEREZ',11274963,2995879687),
    $objPasajero2 = new Pasajero('ENRIQUE','RODRIGUEZ',14684069,1164968234),
    $objPasajero3 = new Pasajero('MANUEL','CONTRERAS',17395869,2615395864),
    $objPasajero4 = new Pasajero('LAURA','LOPEZ',34660938,344985678)];

$arregloViaje2 = [
    $objPasajero5 = new Pasajero('JUAN','ROMERO',30440659,2995967843),
    $objPasajero6 = new Pasajero('DANIEL','FONDACARO',27395587,1164506945),
    $objPasajero7 = new Pasajero('MALENA','DELGADO',22593330,2994079845),
    $objPasajero8 = new Pasajero('PAULA','GUERRA',19220598,26160456783)];


$objViajeT = new ViajeTerrestre('033DFH', 'BUENOS AIRES', 4, 'SEMICAMA', true, 5000, $arregloViaje1, $objResponsableT);
$objViajeA = new ViajeAereo('033DFH', 'BUENOS AIRES', 10, 'PRIMERA', true, 12000, $arregloViaje2, $objResponsableA,456789,'RAIANER',3);


$strMenu1 = "Ingrese 't' si desea modificar el viaje terrestre, 'a' para modificar el viaje aéreo, o 'f' para salir: "; 

$strMenu2 = 
    "0) Ingrese '0' para volver al menú principal.\n" .
    "1) Ingrese '1' para modificar código del viaje. \n" .
    "2) Ingrese '2' para modificar destino del viaje. \n" .
    "3) Ingrese '3' para modificar límite de pasajeros del viaje. \n" .
    "4) Ingrese '4' para modificar la categoría del viaje. \n" .
    "5) Ingrese '5' para indicar si el viaje es de ida y vuelta. \n" .
    "6) Ingrese '6' para modificar el importe base del viaje. \n" .
    "7) Ingrese '7' para modificar el número de vuelo.\n" .
    "8) Ingrese '8' para modificar el nombre de la aerolínea.\n" . 
    "9) Ingrese '9' para modificar el número de escalas del vuelo.\n" .
    "10) Ingrese '10' para vender un pasaje. \n" .
    "11) Ingrese '11' para modificar datos de un pasajero. \n" .
    "12) Ingrese '12' para eliminar pasajero del viaje. \n" .
    "13) Ingrese '13' para modificar la informacion del responsable del viaje. \n" .    
    "14) Ingrese '14' para mostrar información del viaje y de los pasajeros. \n";


echo $strMenu1;
$seleccion1 = trim(fgets(STDIN));
while ($seleccion1 != 't' && $seleccion1 != 'a' && $seleccion1 != 'f'){
    echo "Respuesta inválida. Por favor, ingrese alguno de los valores indicados.\n\n";
    $seleccion1 = trim(fgets(STDIN));
}
while ($seleccion1 == 't' || $seleccion1 == 'a'){
    echo $strMenu2;
    $seleccion2 = trim(fgets(STDIN));
    switch ($seleccion2){
        case 0:
            echo $strMenu1;
            $seleccion1 = trim(fgets(STDIN));
            break;
        case 1:
            echo "Ingrese nuevo código de viaje: ";
            $nuevoCodigo = strtoupper(trim(fgets(STDIN)));
            if ($seleccion1 == 'a'){
                $objViajeA->setCodigo($nuevoCodigo);
            }
            elseif ($seleccion1 == 't'){
                $objViajeT->setCodigo($nuevoCodigo);
            }
            echo "Se ha modificado el código con éxito.\n\n";
            break;
        case 2:
            echo "Ingrese nuevo destino de viaje: ";
            $nuevoDestino = strtoupper(trim(fgets(STDIN)));
            if ($seleccion1 == 'a'){
                $objViajeA->setDestino($nuevoDestino);
            }
            elseif ($seleccion1 == 't'){
                $objViajeT->setDestino($nuevoDestino);   
            }
            echo "Se ha modificado el destino con éxito.\n\n";
            break;
        case 3:
            echo "Ingrese nuevo límite de pasajeros: ";
            $nuevoLimPasajeros = trim(fgets(STDIN));
            if ($seleccion1 == 'a'){
                $objViajeA->setMaxPasajeros($nuevoLimPasajeros);
            }
            elseif ($seleccion1 == 't'){
                $objViajeT->setMaxPasajeros($nuevoLimPasajeros);
            }
            echo "Se ha modificado el límite de pasajeros con éxito.\n\n";            
            break;
        case 4:
            echo "Ingrese la categoría del viaje: ";
            $nuevaCategoria = strtoupper(trim(fgets(STDIN)));
            if ($seleccion1 == 'a'){
                $objViajeA->setCategoria($nuevaCategoria);
            }
            elseif ($seleccion1 == 't'){
                $objViajeT->setCategoria($nuevaCategoria);
            }
            break;
        case 5:
            echo "Ingrese '1' si el viaje es de ida y vuelta, '2' en caso contrario: ";
            $num = trim(fgets(STDIN));
            $nuevoIdaVuelta =  ($num == 1) ? true : false;
            if ($seleccion1 == 'a'){
                $objViajeA->setIdaVuelta($nuevoIdaVuelta);
            }
            elseif ($seleccion1 == 't'){
                $objViajeT->setIdaVuelta($nuevoIdaVuelta);
            }
            break;
        case 6:
            echo "Ingrese nuevo importe del viaje: $";
            $nuevoImporte = trim(fgets(STDIN));
            if ($seleccion1 == 'a'){
                $objViajeA->setImporte($nuevoImporte);
            }
            elseif ($seleccion1 == 't'){
                $objViajeT->setImporte($nuevoImporte);
            }
            break;
        case 7:
            if ($seleccion1 == 'a'){
                echo "Ingrese nuevo número de vuelo: ";
                $nuevoImporte = trim(fgets(STDIN));
                $objViajeA->setNumVuelo($nuevoImporte);
            }
            elseif ($seleccion1 == 't'){
                echo "La opción es sólo disponible para viajes aéreos.\n\n";
            }
            break;
        case 8:
            if ($seleccion1 == 'a'){
                echo "Ingrese nuevo nombre de la aerolínea: ";
                $nuevaAerolinea = trim(fgets(STDIN));
                $objViajeA->setAerolinea($nuevaAerolinea);
            }
            elseif ($seleccion1 == 't'){
                echo "La opción es sólo disponible para viajes aéreos.\n\n";
            }
            break;
        case 9:
            if ($seleccion1 == 'a'){
                echo "Ingrese número de escalas del vuelo: ";
                $nueCantEscalas = trim(fgets(STDIN));
                $objViajeA->setEscalas($nueCantEscalas);
            }
            elseif ($seleccion1 == 't'){
                echo "La opción es sólo disponible para viajes aéreos.\n\n";
            }
            break;
        case 10:
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
            if ($seleccion1 == 'a'){
                $importe = $objViajeA->venderPasaje($objPasajeroAgregar);
            }
            elseif ($seleccion1 == 't'){
                $importe = $objViajeT->venderPasaje($objPasajeroAgregar);
            }            
            if ($importe > 0){
                echo "Se ha añadido el pasajero con éxito. El importe del pasaje es de: $" . $importe . "\n\n";
            }
            else{
                echo "El pasajero ya se encuentra en la lista // Se alcanzó el límite de pasajeros del viaje.\n\n";
            }
            break;
        case 11:
            echo "DNI del pasajero a modificar: ";
            $dniBusco = trim(fgets(STDIN));
            echo "Ingrese datos del pasajero modificados: \n";
            echo "Nombre: ";
            $nombreModif = strtoupper(trim(fgets(STDIN)));
            echo "Apellido: ";
            $apellidoModif = strtoupper(trim(fgets(STDIN)));
            echo "Telefono: ";
            $telefonoModif = trim(fgets(STDIN));
            if ($seleccion1 == 'a'){
                $valMod = $objViajeA->ModificarPasajero($dniBusco,$nombreModif, $apellidoModif,$telefonoModif);
            }
            elseif ($seleccion1 == 't'){
                $valMod = $objViajeT->ModificarPasajero($dniBusco,$nombreModif, $apellidoModif,$telefonoModif);
            }
            if ($valMod == true){
                echo "Se ha modificado el pasajero con éxito.\n\n";
            }
            else{
                echo "El pasajero a modificar no se encuentra en la lista.\n\n";
            }
            break;
        case 12:
            echo "DNI del pasajero a eliminar: \n";
            $dniEliminar = trim(fgets(STDIN));            
            if ($seleccion1 == 'a'){
                $valBorrar = $objViajeA->borrarPasajero($dniEliminar);
            }
            elseif ($seleccion1 == 't'){
                $valBorrar = $objViajeT->borrarPasajero($dniEliminar);
            }
            if ($valBorrar == true){
                echo "Se ha eliminado el pasajero con éxito.\n\n";
            }
            else{
                echo "El pasajero a eliminar no se encuentra en la lista.\n\n";
            }
            break;
        case 13:
            echo "Ingrese los datos a modificar del responsable del viaje: \n";
            echo "Ingrese numero de empleado: ";
            $numEmpleadoRespMod = trim(fgets(STDIN));            
            echo "Ingrese numero de licencia: ";
            $numLicenciaRespMod = trim(fgets(STDIN));            
            echo "Ingrese nombre del responsable: ";
            $nombreRespMod = strtoupper(trim(fgets(STDIN)));            
            echo "Ingrese apellido del responsable: ";
            $apellidoRespMod = strtoupper(trim(fgets(STDIN)));
            if ($seleccion1 == 'a'){
                $objResponsableA->setNumEmpleado($numEmpleadoRespMod);
                $objResponsableA->setNumLicencia($numLicenciaRespMod);
                $objResponsableA->setNombre($nombreRespMod);
                $objResponsableA->setApellido($apellidoRespMod);
            }
            elseif ($seleccion1 == 't'){
                $objResponsableT->setNumEmpleado($numEmpleadoRespMod);
                $objResponsableT->setNumLicencia($numLicenciaRespMod);
                $objResponsableT->setNombre($nombreRespMod);
                $objResponsableT->setApellido($apellidoRespMod);
            }            
            echo "Se han modificado los datos correctamente. \n\n";            
            break;
        case 14:
            if ($seleccion1 == 'a'){
                echo $objViajeA;
            }
            elseif ($seleccion1 == 't'){
                echo $objViajeT;
            }            
            break;
        default:
            echo "Respuesta inválida. Por favor, ingrese un número dentro del rango indicado.\n\n";
            break;
    }
    while ($seleccion1 != 't' && $seleccion1 != 'a' && $seleccion1 != 'f'){
        echo "Respuesta inválida. Por favor, ingrese alguno de los valores indicados.\n\n";
        $seleccion1 = trim(fgets(STDIN));
    }
}
echo "Gracias por utilizar el sistema de gestión de viajes de la empresa.\n\n";
?>