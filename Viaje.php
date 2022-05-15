<?php
class Viaje{
    private $codigo;
    private $destino;
    private $maxPasajeros;
    private $categoria;
    private $esIdaVuelta;
    private $importe;
    private $coleccionPasajeros;
    private $objResponsable;

    public function __construct($codigoViaje, $destinoViaje, $maxCantPasajeros, $categoria, $esIdaVuelta, $importe, $arrayTotalPasajeros, $objResponsableViaje){
        $this->codigo = $codigoViaje;
        $this->destino = $destinoViaje;        
        $this->maxPasajeros = $maxCantPasajeros;
        $this->categoria = $categoria;
        $this->esIdaVuelta = $esIdaVuelta;
        $this->importe = $importe;
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
    public function getCategoria(){
        return $this->categoria;
    }
    public function getIdaVuelta(){
        return $this->esIdaVuelta;
    }
    public function getImporte(){
        return $this->importe;
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
    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }
    public function setIdaVuelta($esIdaVuelta){
        $this->esIdaVuelta = $esIdaVuelta;
    }
    public function setImporte($importe){
        $this->importe = $importe;
    }
    public function setColeccionPasajeros($arrayTotalPasajeros){
        $this->coleccionPasajeros = $arrayTotalPasajeros;
    }
    public function setObjResponsable($objResponsableViaje){
        $this->objResponsable = $objResponsableViaje;
    }

    public function mostrarIdaVuelta(){
        $str = $this->getIdaVuelta() ? 'SI' : 'NO';
        return $str;
    }

    public function mostrarDatosPasajeros(){
        $colPasajeros = $this->getColeccionPasajeros();
        $strMostrar = "DATOS PASAJEROS: \n";
        foreach ($colPasajeros as $i=>$objP){
            $strMostrar .= "[" . ($i+1) . "]: \n"; 
            $strMostrar .= $objP;
        }
        return $strMostrar;
    }
    public function __toString(){
        $strColeccion = $this->mostrarDatosPasajeros();
        return  "Código de viaje: " . $this->getCodigo() . "\n" . 
                "Destino de viaje: " . $this->getDestino() . "\n" . 
                "Cantidad máxima de pasajeros: " . $this->getMaxPasajeros() . "\n" .
                "Categoría de asiento: " . $this->getCategoria() . "\n" .
                "Es ida y vuelta: " . $this->mostrarIdaVuelta() . "\n" . 
                "Importe viaje: " . $this->getImporte() . "\n" . 
                $this->getObjResponsable() . $strColeccion;                
    }

    public function buscarPasajero($dni){
        $aViaje = $this->getColeccionPasajeros();
        $encontro = false;
        $pos = -1;
        $i = 0;
        while ($i < count($aViaje) && !$encontro){
            $dniAct = $aViaje[$i]->getDoc();
            if ($dniAct == $dni){
                $encontro = true;
                $pos = $i;
            }
            $i = $i + 1;
        }
        return $pos;
    }
    /**
     * Esta función permite agregar un pasajero (cuyos datos se ingresan por parámetro) al 
     * arreglo total de pasajeros.
     * @param obj $objNuevoPasajero
     * @param int $dniBusqueda
     */
    public function agregarPasajero ($objNuevoPasajero, $dniBusqueda){
        $colPasajeros = $this->getColeccionPasajeros();
        $seAgrega = false;       
        $pos = $this->buscarPasajero($dniBusqueda);
        if ($pos == -1){            
            $colPasajeros[count($colPasajeros)] = $objNuevoPasajero; 
            $this->setColeccionPasajeros($colPasajeros);
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
        $aPasajeros = $this->getColeccionPasajeros();
        $seModifico = false;
        $posEncuentra = $this->buscarPasajero($dniBuscar);        
        if ($posEncuentra != -1){
            $objPasajeroMod = $aPasajeros[$posEncuentra];
            $objPasajeroMod->setNombre($nombreMod);
            $objPasajeroMod->setApellido($apellidoMod);
            $objPasajeroMod->setTelefono($telefonoMod);
            $seModifico = true;
        }
        return $seModifico;
    }

    /**
     * Esta función permite borrar un elemento del arreglo de pasajeros, a partir del 
     * ingreso de un arreglo con los datos del pasajero.
     * @param int $dniSeBusca
     */
    public function borrarPasajero($dniSeBusca){
        $colPasajeros = $this->getColeccionPasajeros();
        $seBorro = false;
        $posEncuentra = $this->buscarPasajero($dniSeBusca);
        if ($posEncuentra != -1){
            $seBorro = true;
            array_splice($colPasajeros, $posEncuentra, 1);
            $this->setColeccionPasajeros($colPasajeros);
        }
        return $seBorro;
    }

    public function hayPasajesDisponibles(){
        $aPasajeros = $this->getColeccionPasajeros();
        $maxCant = $this->getMaxPasajeros();
        $hayLugar = (count($aPasajeros) < $maxCant) ? true : false;
        return $hayLugar;
    }

    public function venderPasaje($objPasajero){
        $hayDisponibles = $this->hayPasajesDisponibles();
        $seVende = false;
        $importe = 0;
        if ($hayDisponibles){
            $dniP = $objPasajero->getDoc();
            $seVende = $this->agregarPasajero($objPasajero,$dniP);
            if ($seVende){
                $importe = $this->getImporte();
            }
        }
        return $importe;
    }
    
    public function __destruct(){
        return $this . "Instancia destruida. No hay referencias a este objeto.";
    }
}
?>