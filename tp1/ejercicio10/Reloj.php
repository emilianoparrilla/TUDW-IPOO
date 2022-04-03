<?php
class Reloj{
    private $hora;
    private $minutos;
    private $segundos;
    public function __construct ($hora, $minutos, $segundos){
        $this->hora = $hora;
        $this->minutos = $minutos;
        $this->segundos = $segundos;
    }
    public function getHora(){
        return $this->hora;
    }
    public function getMinutos(){
        return $this->minutos;
    }
    public function getSegundos(){
        return $this->segundos;
    }
    public function setHora($hora){
        $this->hora=$hora;
    }
    public function setMinutos($minutos){
        $this->minutos=$minutos;
    }
    public function setSegundos($segundos){
        $this->segundos=$segundos;
    }
    public function puesta_a_cero(){
        $this->setHora(0);
        $this->setMinutos(0);
        $this->setSegundos(0);
    }
    public function incremento(){
        if ($this->getSegundos() == 59){
            $this->setSegundos(0);
            if ($this->getMinutos() == 59){
                $this->setMinutos(0);
                if ($this->getHora() == 23){
                    $this->setHora(0);
                }else{
                    $this->setHora($this->getHora() + 1);
                }
            }else{
                $this->setMinutos($this->getMinutos() + 1);
            }
        }else{
            $this->setSegundos($this->getSegundos() + 1);
        }               
        return $this->getHora() . ":" . $this->getMinutos() . ":" . $this->getSegundos() . "\n\n";
    }
    public function __toString(){
        $horaAct = $this->getHora();
        $minAct = $this->getMinutos();
        $segAct = $this->getSegundos();
        return "La hora actual: " . $horaAct . ":" . $minAct . ":" . $segAct . "\n\n";
    }
    public function __destruct(){
        echo $this . "Instancia destruida. No hay referencias a este objeto.\n";
    }
}