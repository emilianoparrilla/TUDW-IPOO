<?php

class ResponsableV{
    private $numEmpleado;
    private $numLicencia;
    private $nombre;
    private $apellido;

    public function __construct($numeroEmpleado,$numeroLicencia,$nombreResponsable,$apellidoResponsable){
        $this->numEmpleado = $numeroEmpleado;
        $this->numLicencia = $numeroLicencia;
        $this->nombre = $nombreResponsable;
        $this->apellido = $apellidoResponsable;        
    }
    //IMPLEMENTO METODOS DE ACCESO 'get' Y 'set:
    public function getNumEmpleado(){
        return $this->numEmpleado;
    }
    public function getNumLicencia(){
        return $this->numLicencia;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function setNumEmpleado($numeroEmpleado){
        $this->numEmpleado = $numeroEmpleado;
    }
    public function setNumLicencia($numeroLicencia){
        $this->numLicencia = $numeroLicencia;
    }
    public function setNombre($nombreResponsable){
        $this->nombre = $nombreResponsable;
    }
    public function setApellido($apellidoResponsable){
        $this->apellido = $apellidoResponsable;
    }
    public function __toString(){
        return "DATOS RESPONSABLE VIAJE: \n" .
                "NUMERO DE EMPLEADO: " . $this->getNumEmpleado() . "\n" .
                "NUMERO DE LICENCIA: " . $this->getNumLicencia() . "\n" .
                "NOMBRE: " . $this->getNombre() . "\n" .
                "APELLIDO: " . $this->getApellido() . "\n\n";
    }
    public function __destruct(){
        return $this . "Instancia destruida. No hay referencias a este objeto. \n\n";
    }
}
?>