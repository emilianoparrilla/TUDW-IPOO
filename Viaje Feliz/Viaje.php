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
     */
    public function agregarPasajero ($objNuevoPasajero){
        $arregloPasajeros = $this->getColeccionPasajeros();
        $maxCantidad = $this->getMaxPasajeros();
        $seRepite = false;
        for ($i = 0; $i < count($arregloPasajeros); $i++){
            $objDatosPasajero = $arregloPasajeros[$i];
            if ($objNuevoPasajero == $objDatosPasajero){
                $seRepite = true;
            }
        }
        if (($seRepite == false) && (count($arregloPasajeros) < $maxCantidad)){
            $arregloPasajeros[count($arregloPasajeros)] = $objNuevoPasajero; 
            $this->setColeccionPasajeros($arregloPasajeros);
        }
        return $seRepite;
    }

    /**
     * Esta función permite, a través del ingreso de dos parámetros, modificar los datos de
     * un pasajero.
     * @param obj $objPersona
     * @param obj $objPersonaMod
     */
    public function ModificarPasajero($objPersona, $objPersonaMod){
        $arregloDePasajeros = $this->getColeccionPasajeros();
        $i = 0;
        $seModifico = false;
        while ($i < count($arregloDePasajeros) && ($arregloDePasajeros[$i] != $objPersona)){
            $i = $i + 1;
        }
        if ($arregloDePasajeros[$i] == $objPersona){
            $arregloDePasajeros[$i] = $objPersonaMod;
            $this->setColeccionPasajeros($arregloDePasajeros);
            $seModifico = true;
        }
        return $seModifico;
    }

    /**
     * Esta función permite borrar un elemento del arreglo de pasajeros, a partir del 
     * ingreso de un arreglo con los datos del pasajero.
     * @param obj $objPasajeroEliminar
     */
    public function borrarPasajero($objPasajeroEliminar){
        $colPasajeros = $this->getColeccionPasajeros();
        $cantPasajeros = count($colPasajeros);
        $seBorro = false;
        $nuevaColeccion = [];
        $i = 0;
        while (($i < $cantPasajeros) && ($colPasajeros[$i] != $objPasajeroEliminar)){
            $i = $i + 1;
        };
        if ($colPasajeros[$i] == $objPasajeroEliminar){
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