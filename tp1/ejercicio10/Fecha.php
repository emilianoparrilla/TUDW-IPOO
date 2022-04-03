<?php
class Fecha{
    private $anio;
    private $mes;
    private $dia;
    private $vectorMeses =
    [
        1=>["Nombre"=>"Enero", "cantDias"=>31],
        2=>["Nombre"=>"Febrero", "cantDias"=>28],
        3=>["Nombre"=>"Marzo", "cantDias"=>31],
        4=>["Nombre"=>"Abril", "cantDias"=>30],
        5=>["Nombre"=>"Mayo", "cantDias"=>31],
        6=>["Nombre"=>"Junio", "cantDias"=>30],
        7=>["Nombre"=>"Julio", "cantDias"=>31],
        8=>["Nombre"=>"Agosto", "cantDias"=>31],
        9=>["Nombre"=>"Septiembre", "cantDias"=>30],
        10=>["Nombre"=>"Octubre", "cantDias"=>31],
        11=>["Nombre"=>"Noviembre", "cantDias"=>30],
        12=>["Nombre"=>"Diciembre", "cantDias"=>31]
    ];


    public function __construct($dia, $mes, $anio){
        $this->dia = $dia;
        $this->mes = $mes;
        $this->anio = $anio;
        $this->vectorMeses = 
        [
            1=>["Nombre"=>"Enero", "cantDias"=>31],
            2=>["Nombre"=>"Febrero", "cantDias"=>28],
            3=>["Nombre"=>"Marzo", "cantDias"=>31],
            4=>["Nombre"=>"Abril", "cantDias"=>30],
            5=>["Nombre"=>"Mayo", "cantDias"=>31],
            6=>["Nombre"=>"Junio", "cantDias"=>30],
            7=>["Nombre"=>"Julio", "cantDias"=>31],
            8=>["Nombre"=>"Agosto", "cantDias"=>31],
            9=>["Nombre"=>"Septiembre", "cantDias"=>30],
            10=>["Nombre"=>"Octubre", "cantDias"=>31],
            11=>["Nombre"=>"Noviembre", "cantDias"=>30],
            12=>["Nombre"=>"Diciembre", "cantDias"=>31]
        ];         
    }
    public function getAnio(){
        return $this->anio;
    }
    public function getMes(){
        return $this->mes;
    }
    public function getDia(){
        return $this->dia;
    }
    public function getVectorMeses(){
        return $this->vectorMeses;
    }
    public function setAnio($anio){
        $this->anio = $anio;
    }
    public function setMes($mes){
        $this->mes = $mes;
    }
    public function setDia($dia){
        $this->dia = $dia;
    }
    public function setVectorMeses($vectorMeses){
        $this->vectorMeses = $vectorMeses;
    }
    public function fechaAbreviada(){
        return $this->getDia() . "/" . $this->getMes() . "/" . $this->getAnio() . "\n\n";
    }
    public function fechaExtendida(){
        return $this->getDia() . " de " . $this->getVectorMeses()[$this->getMes()]["Nombre"] . " de " . $this->getAnio() . "\n\n";
    }
    public function incrementaUnDia(){        
        if (($this->getDia()) >= ($this->getVectorMeses()[$this->getMes()]["cantDias"])){
            $this->setDia(1);
            if ($this->getMes() == 12){
                $this->setMes(1);
                $this->setAnio($this->getAnio() + 1);
            }
            else{                
                $this->setMes($this->getMes() + 1);
            }
        }
        else{
            $this->setDia($this->getDia() + 1);
        }
        return $this->getDia() . " de " . $this->getVectorMeses()[$this->getMes()]["Nombre"] . " de " . $this->getAnio() . "\n\n";       
    }
    public function esBisiesto(){
        if ((($this->getAnio() % 4 == 0) && ($this->getAnio() % 100 != 0)) ||
            ($this->getAnio() % 400 == 0)){
                $strBisiesto = "El año es bisiesto.\n\n";
        }
        else $strBisiesto = "El año NO es bisiesto.\n\n";
        return $strBisiesto;
    }
    /**
     * Recibe un número de días a incrementar, y una fecha por parámetros.
     * @param int $diasIncremento
     * @param array $fechaRecibida
     * @return obj
     */
    public function incremento($diasIncremento, $fechaRecibida){
        $diaRecibido = $fechaRecibida[0];
        $mesRecibido = $fechaRecibida[1];
        $anioRecibido = $fechaRecibida[2];
        $objFechaRec = new Fecha($diaRecibido, $mesRecibido, $anioRecibido);
        for ($i = 1; $i <= $diasIncremento; $i++){
            $objFechaRec->incrementaUnDia();
        }
        return $objFechaRec . "\n";
    }
    public function __toString(){
        $diaAct = $this->getDia();
        $mesAct = $this->getMes();
        $anioAct = $this->getAnio();
        $arregloMeses = $this->getVectorMeses();
        return "La fecha es: " . $diaAct . " de " . $arregloMeses[$mesAct]["Nombre"] . " de " . $anioAct . "\n";
        //return "La fecha es " . $diaAct;
    }
    public function __destruct(){
        echo $this . " Instancia destruida. No hay referencias a este objeto. \n";
    }
/*
    /**
     * Recibe un número de días a incrementar, y una fecha por parámetros.
     * @param int $diasIncremento
     * @param array $fechaRecibida
     * @return string
     */
    /*
    public function incremento($diasIncremento, $fechaRecibida){
        $diaRecibido = $fechaRecibida[0];
        $mesRecibido = $fechaRecibida[1];
        $anioRecibido = $fechaRecibida[2];
        for ($i = 1; $i <= $diasIncremento; $i++){
            if ($diaRecibido >= ($this->getVectorMeses()[$mesRecibido]["cantDias"])){
                $diaRecibido = 1;
                if ($mesRecibido == 12){
                    $mesRecibido = 1;
                    $anioRecibido = $anioRecibido + 1;
                }
                else{                
                    $mesRecibido = $mesRecibido + 1;
                }
            }
            else{
                $diaRecibido = $diaRecibido + 1;
            }
        }
        return $diaRecibido . " de " . $this->getVectorMeses()[$mesRecibido]["Nombre"] . " de " . $anioRecibido . "\n";
    }
*/
}



