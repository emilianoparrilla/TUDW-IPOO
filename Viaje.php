<?php
class Viaje{
    private $codigo;
    private $destino;
    private $maxPasajeros;
    private $coleccionPasajeros;
    private $objResponsable;

    public function __construct($codigoViaje, $destinoViaje, $maxCantPasajeros, $arrayTotalPasajeros, $objResponsableViaje){
        $this->codigo = $codigoViaje;
        $this->destino = $destinoViaje;
        $this->maxPasajeros = $maxCantPasajeros;
        $this->coleccionPasajeros = $arrayTotalPasajeros;
        $this->objResponsable = $objResponsableViaje;
    }
    //Se implementan los métodos de acceso.
    public function getCodigo(){
        return $this->codigo;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getMaxPasajeros(){
        return $this->maxPasajeros;
    }
    public function getColeccionPasajeros(){
        return $this->coleccionPasajeros;
    }
    public function getObjResponsable(){
        return $this->objResponsable;
    }

    public function setCodigo($codigoViaje){
        $this->codigo = $codigoViaje;
    }
    public function setDestino($destinoViaje){
        $this->destino = $destinoViaje;
    }
    public function setMaxPasajeros($maxCantPasajeros){
        $this->maxPasajeros = $maxCantPasajeros;
    }
    public function setColeccionPasajeros($arrayTotalPasajeros){
        $this->coleccionPasajeros = $arrayTotalPasajeros;
    }
    public function setObjResponsable($objResponsableViaje){
        $this->objResponsable = $objResponsableViaje;
    }

    /**
     * Esta función permite agregar un pasajero (cuyos datos se ingresan por parámetro) al 
     * arreglo total de pasajeros.
     * @param obj $objNuevoPasajero
     * @param int $dniBusqueda
     */
    public function agregarPasajero ($objNuevoPasajero, $dniBusqueda){
        $arregloPasajeros = $this->getColeccionPasajeros();
        $maxCantidad = $this->getMaxPasajeros();
        $seRepite = false;
        $seAgrega = false;
        $i = 0;
        while ($i < count($arregloPasajeros) && $seRepite == false){
            $dniPasajeroActual = $arregloPasajeros[$i]->getDoc();
            if ($dniPasajeroActual == $dniBusqueda){
                $seRepite = true;
            }
            $i = $i + 1;
        }
        if (($seRepite == false) && (count($arregloPasajeros) < $maxCantidad)){
            $arregloPasajeros[count($arregloPasajeros)] = $objNuevoPasajero; 
            $this->setColeccionPasajeros($arregloPasajeros);
            $seAgrega = true;
        }
        return $seAgrega;
    }

    /**
     * Esta función permite, a través del ingreso de dos parámetros, modificar los datos de
     * un pasajero.
     * @param int $dniBuscar, $telefonoMod
     * @param string $nombreMod, $apellidoMod
     */
    public function ModificarPasajero($dniBuscar, $nombreMod, $apellidoMod, $telefonoMod){
        $arregloDePasajeros = $this->getColeccionPasajeros();
        $i = 0;
        $seModifico = false;
        do{
            $dniActual = $arregloDePasajeros[$i]->getDoc();
            if ($dniActual == $dniBuscar){
                $objPasajeroMod = $arregloDePasajeros[$i];
                $objPasajeroMod->setNombre($nombreMod);
                $objPasajeroMod->setApellido($apellidoMod);
                $objPasajeroMod->setTelefono($telefonoMod);
                $this->setColeccionPasajeros($arregloDePasajeros);
                $seModifico = true;
            }
            $i = $i + 1;
        }while ($i < count($arregloDePasajeros) && ($seModifico == false));
        return $seModifico;
    }

    /**
     * Esta función permite borrar un elemento del arreglo de pasajeros, a partir del 
     * ingreso de un arreglo con los datos del pasajero.
     * @param int $dniSeBusca
     */
    public function borrarPasajero($dniSeBusca){
        $colPasajeros = $this->getColeccionPasajeros();
        $cantPasajeros = count($colPasajeros);
        $seBorro = false;
        $nuevaColeccion = [];
        $i = 0;
        do{
            $dniElemento = $colPasajeros[$i]->getDoc();
            if ($dniElemento == $dniSeBusca){
                $k = 0;
                while ($k < ($cantPasajeros - 1) && ($k != $i)){            
                    $nuevaColeccion[$k] = $colPasajeros[$k];      
                    $k = $k + 1;
                }
                if ($k == $i){
                    for ($j = $k; $j < ($cantPasajeros - 1); $j++){
                        $nuevaColeccion[$j] = $colPasajeros[$j+1];
                    }
                }
                $this->setColeccionPasajeros($nuevaColeccion);
                $seBorro = true;
            }
            $i = $i + 1;
        }while (($i < $cantPasajeros) && ($seBorro == false));        
        return $seBorro;
    }
    
    public function mostrarDatosPasajeros(){
        $coleccionTotal = $this->getColeccionPasajeros();
        $strMostrar = "DATOS PASAJEROS: \n";
        for ($i=0; $i < count($coleccionTotal); $i++){
            $objInfoPasajero = $coleccionTotal[$i];
            $strMostrar .= "[" . ($i+1) . "]: \n"; 
            $strMostrar .= $objInfoPasajero;
        }
        return $strMostrar;
    }
    public function __toString(){
        $strColeccion = $this->mostrarDatosPasajeros();
        return "Código de viaje: " . $this->getCodigo() . "\n" . 
                "Destino de viaje: " . $this->getDestino() . "\n" . 
                "Cantidad máxima de pasajeros: " . $this->getMaxPasajeros() . "\n" .
                $this->getObjResponsable() . $strColeccion;
    }
    
    public function __destruct(){
        return $this . "Instancia destruida. No hay referencias a este objeto.";
    }
}
?>