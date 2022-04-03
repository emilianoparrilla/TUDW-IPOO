<?php
class Viaje{
    private $codigo;
    private $destino;
    private $maxPasajeros;
    private $arrayPasajeros;

    public function __construct($codigoViaje, $destinoViaje, $maxCantPasajeros, $arrayTotalPasajeros){
        $this->codigo = $codigoViaje;
        $this->destino = $destinoViaje;
        $this->maxPasajeros = $maxCantPasajeros;
        $this->arrayPasajeros = $arrayTotalPasajeros;
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
    public function getArrayPasajeros(){
        return $this->arrayPasajeros;
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
    public function setArrayPasajeros($arrayTotalPasajeros){
        $this->arrayPasajeros = $arrayTotalPasajeros;
    }

    /**
     * Esta función permite agregar un pasajero (cuyos datos se ingresan por parámetro) al 
     * arreglo total de pasajeros.
     * @param $arrayPersona
     */
    public function agregarPasajero ($arrayPersona){
        $arregloPasajeros = $this->getArrayPasajeros();
        $maxCantidad = $this->getMaxPasajeros();
        if (count($arregloPasajeros) < $maxCantidad){
            $arregloPasajeros[count($arregloPasajeros)] = $arrayPersona; 
        }
        $this->setArrayPasajeros($arregloPasajeros);
    }

    /**
     * Esta función permite, a través del ingreso de dos parámetros, modificar los datos de
     * un pasajero.
     * @param array $persona
     * @param array $personaModificada
     */
    public function ModificarPasajero($persona, $personaModificada){
        $arregloDePasajeros = $this->getArrayPasajeros();
        $i = 0;
        while ($i < count($arregloDePasajeros) && ($arregloDePasajeros[$i] != $persona)){
            $i = $i + 1;
        }
        if ($arregloDePasajeros[$i] == $persona){
            $arregloDePasajeros[$i] = $personaModificada;
        }
        $this->setArrayPasajeros($arregloDePasajeros);
    }

    /**
     * Esta función permite borrar un elemento del arreglo de pasajeros, a partir del 
     * ingreso de un arreglo con los datos del pasajero.
     * @param array $personaEliminar
     */
    public function borrarPasajero($personaEliminar){
        $datosTotalPasajeros = $this->getArrayPasajeros();
        $i = 0;
        while ($i < count($datosTotalPasajeros) && ($datosTotalPasajeros[$i] != $personaEliminar)){
            $i = $i + 1;
        }
        if ($datosTotalPasajeros[$i] == $personaEliminar){
            array_splice ($datosTotalPasajeros, $i, 1);
        }
        $this->setArrayPasajeros($datosTotalPasajeros);
    }

    public function __toString(){
        return "Código de viaje: " . $this->getCodigo() . "\n" . 
                "Destino de viaje: " . $this->getDestino() . "\n" . 
                "Cantidad máxima de pasajeros: " . $this->getMaxPasajeros() . "\n\n";            
    }
    
    public function __destruct(){
        return $this . "Instancia destruida. No hay referencias a este objeto.";
    }
}
?>