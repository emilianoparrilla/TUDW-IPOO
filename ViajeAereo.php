<?php

/* . De los viajes aéreos se conoce el número del vuelo, la categoría del asiento (primera clase o no), 
    nombre de la aerolínea, y la cantidad de escalas del vuelo en caso de tenerlas. */

class ViajeAereo extends Viaje{
    private $numVuelo;
    private $aerolinea;
    private $escalas;

    public function __construct($codigoViaje, $destinoViaje, $maxCantPasajeros, $categoria, $esIdaVuelta, $importe, $arrayTotalPasajeros, 
                                    $objResponsableViaje,$numVuelo, $aerolinea, $escalas){
        parent::__construct($codigoViaje, $destinoViaje, $maxCantPasajeros, $categoria, $esIdaVuelta, $importe, $arrayTotalPasajeros, $objResponsableViaje);
        $this->numVuelo = $numVuelo;
        $this->aerolinea = $aerolinea;
        $this->escalas = $escalas;
    }

    public function getNumVuelo(){
        return $this->numVuelo;
    }
    public function getAerolinea(){
        return $this->aerolinea;
    }
    public function getEscalas(){
        return $this->escalas;
    }
    public function setNumVuelo($numVuelo){
        $this->numVuelo = $numVuelo;
    }
    public function setAerolinea($aerolinea){
        $this->aerolinea = $aerolinea;
    }
    public function setEscalas($escalas){
        $this->escalas = $escalas;
    }
    public function __toString(){
        $str = parent::__toString();
        return  "DATOS VIAJE AÉREO: \n" . 
                "Número de vuelo: " . $this->getNumVuelo() . "\n" .
                "Aerolínea: " . $this->getAerolinea() . "\n" . 
                "Escalas: " . $this->getEscalas() . "\n" . $str;
    }

    public function venderPasaje($objPasajero){
        $importe = parent::venderPasaje($objPasajero);
        $clase = $this->getCategoria();
        $escalas = $this->getEscalas();
        $esIdaVuelta = $this->getIdaVuelta();
        if ($importe > 0){
            if ($clase == 'PRIMERA' && $escalas == 0){
                $importe += 0.4 * $importe;
            }
            elseif ($clase == 'PRIMERA' && $escalas > 0){
                $importe += 0.6 * $importe;
            }
            if ($esIdaVuelta){
                $importe += 0.5 * $importe;
            }            
        }
        return $importe;
    }
}
?>