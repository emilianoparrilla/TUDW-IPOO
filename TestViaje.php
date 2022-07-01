<?php

include 'BaseDatos.php';
include 'Responsable.php';
include 'Pasajero.php';
include 'Viaje.php';
include 'Empresa.php';

$strMenu = 
    "0) Ingrese '0' para salir.\n" .
    "1) Ingrese '1' para ingresar un viaje. \n" .
    "2) Ingrese '2' para modificar importe del viaje. \n" .
    "3) Ingrese '3' para modificar destino del viaje. \n" .
    "4) Ingrese '4' para eliminar un viaje. \n" .
    "5) Ingrese '5' para modificar límite de pasajeros del viaje. \n" .
    "6) Ingrese '6' para agregar pasajero. \n" .
    "7) Ingrese '7' para modificar datos de un pasajero. \n" .
    "8) Ingrese '8' para eliminar pasajero del viaje. \n" .
    "9) Ingrese '9' para ingresar una empresa. \n" .
    "10) Ingrese '10' para eliminar una empresa. \n" .
    "11) Ingrese '11' para modificar la información la empresa. \n" .
    "12) Ingrese '12' para mostrar información del viaje y de los pasajeros. \n";

echo $strMenu;
$seleccion = trim(fgets(STDIN));
while ($seleccion != 0){
    switch ($seleccion){
        case 1:            
            echo "Ingrese destino: ";
            $nueDestino = strtoupper(trim(fgets(STDIN)));
            echo "Ingrese límite de pasajeros: ";
            $nueLim = trim(fgets(STDIN));
            echo "Ingrese importe: ";
            $nueImporte = trim(fgets(STDIN));
            echo "Ingrese tipo de asiento (cama-semicama): ";
            $nueTipoAsiento = strtoupper(trim(fgets(STDIN)));
            echo "Ingrese si es ida y vuelta(si-no): ";
            $nueIdaVuelta = strtoupper(trim(fgets(STDIN)));
            if ($nueIdaVuelta == "SI"){
                $nueIdaVuelta = true;
            } else{
                $nueIdaVuelta = false;
            }
            $objNueViaje = new Viaje();
            $aViajes = $objNueViaje->listarViajes("vdestino = '" . $nueDestino . "'");
            if ($aViajes == null){
                $objResponsable = new Responsable();
                $objResponsable->buscarResp(53);
                echo "Ingrese id de la empresa a la cual se asocia el viaje: ";
                $idE = trim(fgets(STDIN));                
                $objEmpresa = new Empresa();
                $rBuscEmp = $objEmpresa->buscarEmp($idE);
                if ($rBuscEmp){
                    $objNueViaje->cargarDatos($nueDestino,$nueLim,$objResponsable,$objEmpresa,$nueImporte,$nueTipoAsiento,$nueIdaVuelta);            
                    $respuestaV = $objNueViaje->insertarViaje();
                    echo $respuestaV ? "El viaje se cargó exitosamente en la BD.\n\n" : $objNueViaje->getMsjOperacion() . "\n\n";
                } else{
                    echo "No se encontró la empresa con el id ingresado.\n" . $objEmpresa->getMsjOperacion() . "\n\n";
                }
            } else{
                echo "El destino ya existe. No se puede agregar viaje a la BD.\n\n";
            }
        break;
        case 2:
            echo "Ingrese id del viaje a modificar: ";
            $idBusqueda = trim(fgets(STDIN));
            $nueObjViaje = new Viaje();
            $resp = $nueObjViaje->buscarViaje($idBusqueda);
            if ($resp){                
                echo "Ingrese nuevo importe de viaje: ";
                $nuevoImp = strtoupper(trim(fgets(STDIN)));
                $nueObjViaje->setImporte($nuevoImp);
                echo $resp = $nueObjViaje->modificarViaje() ? "Se ha modificado el importe con éxito.\n\n" : $nueObjViaje->getMsjOperacion() . "\n\n";
            } else{
                echo "No se encontró el viaje con el id ingresado.\n" . $nueObjViaje->getMsjOperacion() . "\n\n";
            }
        break;
        case 3:
            echo "Ingrese id del viaje a modificar: ";
            $idBusqueda = trim(fgets(STDIN));
            $nueObjViaje = new Viaje();
            $resp = $nueObjViaje->buscarViaje($idBusqueda);
            if ($resp){
                echo "Ingrese nuevo destino de viaje: ";
                $nueDestino = strtoupper(trim(fgets(STDIN)));
                $colViajes = $nueObjViaje->listarViajes("vdestino = '" . $nueDestino . "'");
                if ($colViajes == null){
                    $nueObjViaje->setDestino($nueDestino);
                    echo $resp = $nueObjViaje->modificarViaje() ? "Se ha modificado el destino con éxito.\n\n" : $nueObjViaje->getMsjOperacion() . "\n\n";
                } else{
                    echo "El destino ya existe. No se puede modificar viaje.\n\n";
                }
            } else{
                echo "No se encontró el viaje con el id ingresado.\n" . $nueObjViaje->getMsjOperacion() . "\n\n";
            }            
        break;
        case 4:
            echo "Ingrese el id de viaje a eliminar: ";
            $idIng = trim(fgets(STDIN));
            $objViaje = new Viaje();
            $r = $objViaje->buscarViaje($idIng);
            if ($r){
                $objPasaj = new Pasajero();
                $colPasajeros = $objPasaj->listarPasaj("idviaje=" . $objViaje->getIdViaje());
                if ($colPasajeros == null){
                    $resElimViaje = $objViaje->eliminarViaje();
                    echo $resElimViaje ? "Se ha eliminado el viaje correctamente.\n\n" : $objViaje->getMsjOperacion() . "\n\n";                
                } else{
                    echo "El viaje no se puede eliminar ya que contiene pasajeros.\n\n";
                }
            } else{
                echo "No se encontró el viaje con el id ingresado.\n" . $objViaje->getMsjOperacion() . "\n\n";
            }
        break;
        case 5:
            echo "Ingrese id del viaje a modificar: ";
            $idV = trim(fgets(STDIN));
            $objViaje = new Viaje();
            $resp = $objViaje->buscarViaje($idV);
            if ($resp){
                echo "Ingrese nuevo límite de pasajeros: ";
                $nuevoLim = trim(fgets(STDIN));
                $objPasaj = new Pasajero();
                $aPasaj = $objPasaj->listarPasaj("idviaje=" . $objViaje->getIdViaje());
                $condicion = false;
                if ($aPasaj == null){
                    $condicion = true;
                } else{
                    $cantPasaj = count($aPasaj);
                    if ($cantPasaj <= $nuevoLim){
                        $condicion = true;
                    } else{
                        echo "El nuevo límite no puede ser menor a la cantidad de pasajeros del viaje.\n\n";
                    }
                }
                if ($condicion){                    
                    $objViaje->setMaxPasajeros($nuevoLim);
                    echo $respModV = $objViaje->modificarViaje() ? "Se ha modificado el límite de pasajeros con éxito.\n\n" : $objViaje->getMsjOperacion() . "\n\n";
                }
            } else{
                echo "No se encontró el viaje con el id ingresado.\n" . $objViaje->getMsjOperacion() . "\n\n";
            }
        break;
        case 6:
            echo "Ingrese datos del pasajero a añadir: ";
            echo "Nombre: ";
            $nombreAgregar = strtoupper(trim(fgets(STDIN)));
            echo "Apellido: ";
            $apellidoAgregar = strtoupper(trim(fgets(STDIN)));
            echo "DNI: ";
            $dniAgregar = trim(fgets(STDIN));
            echo "Telefono: ";
            $telefonoAgregar = trim(fgets(STDIN));
            echo "Ingrese id de viaje a agregar: ";
            $idBusc = trim(fgets(STDIN));
            $objViaje = new Viaje();
            $resp = $objViaje->buscarViaje($idBusc);
            if ($resp){            
                $objPasajeroAgregar = new Pasajero();
                $objPasajeroAgregar->cargarDatos($nombreAgregar,$apellidoAgregar,$dniAgregar,$telefonoAgregar,$objViaje);
                $coleccion = $objPasajeroAgregar->listarPasaj("idviaje=" . $objViaje->getIdViaje());
                $limPasajeros = $objViaje->getMaxPasajeros();
                if ($coleccion == null || count($coleccion) < $limPasajeros){
                    $respAgregarPasaj = $objPasajeroAgregar->buscarPasaj($dniAgregar);
                    if (!$respAgregarPasaj){
                        $respInsertPasaj = $objPasajeroAgregar->insertarPasaj();
                        echo $respInsertPasaj ? "Se ha añadido el pasajero con éxito.\n\n" : $objPasajeroAgregar->getMsjOperacion() . "\n\n";
                    } else{
                        echo "El pasajero ya se encuentra en la lista.\n\n";
                    }
                } else{
                    echo "Se alcanzó el límite de pasajeros del viaje.\n\n";
                }
            } else{
                echo "No se encontró el viaje con el id ingresado.\n" . $objViaje->getMsjOperacion() . "\n\n";
            }
        break;
        case 7:
            echo "DNI del pasajero a modificar: ";
            $dniBusco = trim(fgets(STDIN));
            echo "Ingrese datos del pasajero modificados: ";
            echo "Nombre: ";
            $nombreModif = strtoupper(trim(fgets(STDIN)));
            echo "Apellido: ";
            $apellidoModif = strtoupper(trim(fgets(STDIN)));
            echo "Telefono: ";
            $telefonoModif = trim(fgets(STDIN));
            $objPasajMod = new Pasajero();
            $respBusco = $objPasajMod->buscarPasaj($dniBusco);
            if ($respBusco){
                $objPasajMod->setNombre($nombreModif);
                $objPasajMod->setApellido($apellidoModif);
                $objPasajMod->setTelefono($telefonoModif);
                $respMod = $objPasajMod->modificarPasaj();
                echo $respMod ? "Se ha modificado el pasajero con éxito.\n\n" : $objPasajMod->getMsjOperacion() . "\n\n";
            } else{
                echo "No se encontró el pasajero con el dni ingresado.\n" .  $objPasajMod->getMsjOperacion() . "\n\n";
            }
        break;
        case 8:
            echo "DNI del pasajero a eliminar: ";
            $dniEliminar = trim(fgets(STDIN));
            $objPasajElim = new Pasajero();
            $respBusc = $objPasajElim->buscarPasaj($dniEliminar);
            if ($respBusc){
                $respBorrar = $objPasajElim->eliminarPasaj();
                echo $respBorrar ? "Se ha eliminado el pasajero con éxito.\n\n" : $objPasajElim->getMsjOperacion() . "\n\n";
            } else{
                echo "No se encontró el pasajero con el dni ingresado.\n" .  $objPasajElim->getMsjOperacion() . "\n\n";
            }
        break;
        case 9:
            echo "Ingrese nombre de empresa: ";
            $nombreEmp = strtoupper(trim(fgets(STDIN)));
            echo "Ingrese la dirección de la empresa: ";
            $dirEmp = strtoupper(trim(fgets(STDIN)));
            $objEmp = new Empresa();
            $colEmpresas = $objEmp->listarEmp("enombre = '" . $nombreEmp . "'");
            if ($colEmpresas == null){
                $objEmp->cargarDatos($nombreEmp,$dirEmp);
                $resIns = $objEmp->insertarEmp();
                echo $resIns ? "La empresa se cargó correctamente a la BD.\n\n" : $objEmp->getMsjOperacion() . "\n\n";
            } else{
                echo "El nombre de la empresa ya existe. La empresa no se puede agregar.\n\n";
            }
        break;
        case 10:
            echo "Ingrese el id de la empresa a eliminar: ";
            $idEmp = trim(fgets(STDIN));
            $objElimEmp = new Empresa();
            $rBuscar = $objElimEmp->buscarEmp($idEmp);
            if ($rBuscar){
                $objViaje = new Viaje();
                $colViajes = $objViaje->listarViajes("idempresa = " . $idEmp);
                if ($colViajes == null){
                    $rElim = $objElimEmp->eliminarEmp();
                    echo $rElim ? "La empresa se eliminó correctamente.\n\n" : $objElimEmp->getMsjOperacion() . "\n\n";
                } else{
                    echo "La empresa tiene viajes asociados, por lo tanto, no se puede eliminar\n\n";
                }
            } else{
                echo "No se encontró la empresa con el id ingresado.\n" . $objElimEmp->getMsjOperacion() . "\n\n";
            }
        break;
        case 11:
            echo "Ingrese id de la empresa a modificar: ";
            $idEmpBuscar = strtoupper(trim(fgets(STDIN)));
            echo "Ingrese nombre de empresa modificado: ";
            $nombreEmpMod = strtoupper(trim(fgets(STDIN)));
            echo "Ingrese la dirección de la empresa modificado:";
            $dirEmpMod = strtoupper(trim(fgets(STDIN)));
            $objEmpresaMod = new Empresa();
            $respBus = $objEmpresaMod->buscarEmp($idEmpBuscar);
            if ($respBus){                
                $colEmpresas = $objEmpresaMod->listarEmp("enombre = '" . $nombreEmpMod . "'");
                if ($colEmpresas == null || $objEmpresaMod->getNombre() == $nombreEmpMod){
                    $objEmpresaMod->setNombre($nombreEmpMod);
                    $objEmpresaMod->setDireccion($dirEmpMod);
                    $respMod = $objEmpresaMod->modificarEmp();
                    echo $respMod ? "Los datos de la empresa han sido modificados.\n\n" : $objEmpresaMod->getMsjOperacion() . "\n\n";
                } else{
                    echo "El nombre de la empresa ya existe, no se puede modificar.\n\n";
                }
            } else{
                echo "No se encontró la empresa con el id ingresado.\n" . $objEmpresaMod->getMsjOperacion() . "\n\n";
            }
        break;
        case 12:
            echo "Ingrese id del viaje a buscar: ";
            $idBusc = trim(fgets(STDIN));
            $nueObjViaje = new Viaje();
            $resBuscViaje = $nueObjViaje->buscarViaje($idBusc);
            if ($resBuscViaje){
                $nueObjPasajero = new Pasajero();                
                echo $nueObjViaje;
            } else{
                echo "No se encontró el viaje con el id ingresado.\n" . $nueObjViaje->getMsjOperacion() . "\n\n";
            }
        break;
    }
    echo $strMenu;
    $seleccion = trim(fgets(STDIN));
}
?>