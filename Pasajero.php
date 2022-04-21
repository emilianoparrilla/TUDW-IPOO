<?php

class Pasajero{
    private $nombre;
    private $apellido;
    private $doc;
    private $telefono;

    public function __construct($nombrePasajero,$apellidoPasajero,$documento,$numTelefono){
        $this->nombre=$nombrePasajero;
        $this->apellido=$apellidoPasajero;
        $this->doc=$documento;
        $this->telefono=$numTelefono;
    }
    //IMPLEMENTO METODOS DE ACCESO 'get' y 'set':
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getDoc(){
        return $this->doc;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function setNombre($nombrePasajero){
        $this->nombre = $nombrePasajero;
    }
    public function setApellido($apellidoPasajero){
        $this->apellido = $apellidoPasajero;
    }
    public function setDoc($documento){
        $this->doc = $documento;
    }
    public function setTelefono($numTelefono){
        $this->telefono = $numTelefono;
    }
    public function __toString(){
        return "DATOS PASAJERO: \n" .
            "NOMBRE: " . $this->getNombre() . "\n" .
            "APELLIDO: " . $this->getApellido() . "\n" .
            "DOCUMENTO: " . $this->getDoc() . "\n" .
            "TELEFONO: " . $this->getTelefono() . "\n\n";
    }
    public function __destruct(){
        return $this . "Instancia destruida. No hay referencias a este objeto. \n\n";
    }
}
?>