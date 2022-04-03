<?php
include 'Viaje.php';

$arregloViaje = [
                0 => ['Nombre' => 'Tobias', 'Apellido' => 'Perez', 'DNI' => 11274963],
                1 => ['Nombre' => 'Enrique', 'Apellido' => 'Rodriguez', 'DNI' => 14684069],
                2 => ['Nombre' => 'Manuel', 'Apellido' => 'Contreras', 'DNI' => 17395869],
                3 => ['Nombre' => 'Laura', 'Apellido' => 'Lopez', 'DNI' => 34660938],
                4 => ['Nombre' => 'Juan', 'Apellido' => 'Romero', 'DNI' => 30440659],
                5 => ['Nombre' => 'Daniel', 'Apellido' => 'Fondacaro', 'DNI' => 27395587],
                6 => ['Nombre' => 'Malena', 'Apellido' => 'Delgado', 'DNI' => 22593330],
                7 => ['Nombre' => 'Paula', 'Apellido' => 'Guerra', 'DNI' => 19220598]
];

$objViaje = new Viaje('033#56fh', 'Buenos Aires', 17, $arregloViaje);

/**
 * @param object $objViaje
 */
function mostrarDatosPasajeros($objViaje){
    for ($i = 0; $i < count ($objViaje->getArrayPasajeros()); $i++){
        echo "[" . $i . "]: \n";
        foreach ($objViaje->getArrayPasajeros()[$i] as $k => $dato){
            echo $k . ":" . $dato . "\n";
        }
        echo "\n";
    }
}

$strMenu = 
    "0) Ingrese '0' para salir.\n" .
    "1) Ingrese '1' para modificar código del viaje. \n" .
    "2) Ingrese '2' para modificar destino del viaje. \n" .
    "3) Ingrese '3' para modificar límite de pasajeros del viaje. \n" .
    "4) Ingrese '4' para agregar pasajero. \n" .
    "5) Ingrese '5' para modificar datos de un pasajero. \n" .
    "6) Ingrese '6' para eliminar pasajero del viaje. \n" .
    "7) Ingrese '7' para mostrar datos del viaje. \n" . 
    "8) Ingrese '8' para mostrar datos de todos los pasajeros.\n"
;
echo $strMenu;
$seleccion = trim(fgets(STDIN));
while ($seleccion != 0){
    switch ($seleccion){
        case 1:
            echo "Ingrese nuevo código de viaje: ";
            $nuevoCodigo = strtoupper(trim(fgets(STDIN)));
            $objViaje->setCodigo($nuevoCodigo);
            echo "Se ha modificado el código con éxito.\n";
            break;
        case 2:
            echo "Ingrese nuevo destino de viaje: ";
            $nuevoDestino = trim(fgets(STDIN));
            $objViaje->setDestino($nuevoDestino);
            echo "Se ha modificado el destino con éxito.\n";
            break;
        case 3:
            echo "Ingrese nuevo límite de pasajeros: ";
            $nuevoLimPasajeros = trim(fgets(STDIN));
            $objViaje->setMaxPasajeros($nuevoLimPasajeros);
            echo "Se ha modificado el límite de pasajeros con éxito.\n";
            break;
        case 4:
            echo "Ingrese datos del pasajero a añadir: \n";
            echo "Nombre: ";
            $nombreAgregar = trim(fgets(STDIN));
            echo "Apellido: ";
            $apellidoAgregar = trim(fgets(STDIN));
            echo "DNI: ";
            $dniAgregar = trim(fgets(STDIN));
            $pasajeroAgregar = ['Nombre' => $nombreAgregar, 'Apellido' => $apellidoAgregar, 'DNI' => $dniAgregar];
            $objViaje->agregarPasajero(['Nombre' => $nombreAgregar, 'Apellido' => $apellidoAgregar, 'DNI' => $dniAgregar]);
            echo "Se ha añadido el pasajero con éxito.\n";
            break;
        case 5:
            echo "Ingrese datos del pasajero a modificar: \n";
            echo "Nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "Apellido: ";
            $apellido = trim(fgets(STDIN));
            echo "DNI: ";
            $dni = trim(fgets(STDIN));
            $pasajero = ['Nombre' => $nombre, 'Apellido' => $apellido, 'DNI' => $dni];
            echo "Ingrese datos del pasajero modificados: \n";
            echo "Nombre: ";
            $nombreMod = trim(fgets(STDIN));
            echo "Apellido: ";
            $apellidoMod = trim(fgets(STDIN));
            echo "DNI: ";
            $dniMod = trim(fgets(STDIN));
            $pasajeroMod = ['Nombre' => $nombreMod, 'Apellido' => $apellidoMod, 'DNI' => $dniMod];
            $objViaje->ModificarPasajero($pasajero, $pasajeroMod);
            echo "Se ha modificado el pasajero con éxito.\n";
            break;
        case 6:
            echo "Ingrese datos del pasajero a eliminar: \n";
            echo "Nombre: ";
            $nombreEliminar = trim(fgets(STDIN));
            echo "Apellido: ";
            $apellidoEliminar = trim(fgets(STDIN));
            echo "DNI: ";
            $dniEliminar = trim(fgets(STDIN));
            $pasajeroEliminar = ['Nombre' => $nombreEliminar, 'Apellido' => $apellidoEliminar, 'DNI' => $dniEliminar];
            $objViaje->borrarPasajero($pasajeroEliminar);
            echo "Se ha eliminado el pasajero con éxito.\n";
            break;
        case 7:
            echo "****DATOS DEL VIAJE****\n";
            echo $objViaje;
            break;
        case 8:
            echo "****DATOS DE LOS PASAJEROS****\n";
            mostrarDatosPasajeros($objViaje);
            break;
    }
    echo$strMenu;
    $seleccion = trim(fgets(STDIN));
}



//mostrarDatosPasajeros($objViaje);

/*
$objViaje->setCodigo('034$$25');//Modificar código de viaje.
$objViaje->setDestino('Mendoza Capital');//Modificar destino.
$objViaje->setMaxPasajeros(10);//Modificar cantidad máxima de pasajeros.
echo $objViaje;

$objViaje->agregarPasajero(['Nombre' => 'Martin', 'Apellido' => 'Buenaventura', 'DNI' => 38459067]);
echo "****Pasajero añadido: ****\n";
$objViaje->mostrarDatosPasajeros();

$objViaje->borrarPasajero($arregloViaje[2]);
echo "****Pasajero eliminado: ****\n";
$objViaje->mostrarDatosPasajeros();

$objViaje->ModificarPasajero($arregloViaje[7], ['Nombre' => 'Paula', 'Apellido' => 'Guerrero', 'DNI' => 19220598]);
echo "****Pasajero modificado: ****\n";
$objViaje->mostrarDatosPasajeros();
*/
?>