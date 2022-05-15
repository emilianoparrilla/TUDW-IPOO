<?php

class ViajeTerrestre extends Viaje{

    public function __toString(){
        $str = parent::__toString();
        return "DATOS VIAJE TERRESTRE:\n" . $str;
    }

    public function venderPasaje($objPasajero){
        $importe = parent::venderPasaje($objPasajero);
        $categoria = $this->getCategoria();
        $esIdaVuelta = $this->getIdaVuelta();
        if ($importe > 0){
            if ($categoria == 'CAMA'){
                $importe += 0.25 * $importe;
            }
            if ($esIdaVuelta){
                $importe += 0.5 * $importe;
            }
        }
        return $importe;
    }
}
?>
