<?php
class CuentaBancaria{
    private $numCuenta;
    private $dniCliente;
    private $saldoActual;
    private $interesAnual;
    public function __construct($numeroCuenta, $documentoCliente, $saldo, $interes){
        $this->numCuenta = $numeroCuenta;
        $this->dniCliente = $documentoCliente;
        $this->saldoActual = $saldo;
        $this->interesAnual = $interes;
    }
    public function getNumCuenta(){
        return $this->numCuenta;
    }
    public function getDniCliente(){
        return $this->dniCliente;
    }
    public function getSaldoActual(){
        return $this->saldoActual;
    }
    public function getInteresAnual(){
        return $this->interesAnual;
    }
    public function setNumCuenta($numeroCuenta){
        $this->numCuenta = $numeroCuenta;
    }
    public function setDniCliente($documentoCliente){
        $this->dniCliente = $documentoCliente;
    }
    public function setSaldoActual($saldo){
        $this->saldoActual = $saldo;
    }
    public function setInteresAnual($interes){
        $this->interesAnual = $interes;
    }
    public function actualizarSaldo(){
        $interesDiario = $this->getInteresAnual() / 365;
        $saldoActualizado = $this->getSaldoActual() - $interesDiario;
        $this->setSaldoActual($saldoActualizado);
    }
    /**
     * Esta función permite ingresar una cantidad a depositar en la cuenta a través de un
     * parámetro.
     * @param float $cant
     */
    public function depositar ($cant){
        $saldoTotal = $this->getSaldoActual() + $cant;
        $this->setSaldoActual($saldoTotal);
    }
    /**
     * Esta función permite ingresar una cantidad a depositar en la cuenta a través de un
     * parámetro.
     * @param float $cant
     * @return string
     */
    public function retirar ($cant){
        if ($this->getSaldoActual() > $cant){
            $saldoTotal = $this->getSaldoActual() - $cant;
            $this->setSaldoActual($saldoTotal);
            $mensaje = "Se retiró la cantidad " . $cant . ". Tu saldo actual es " . $saldoTotal;
        }
        else{
            $mensaje = "No se pudo retirar. La cantidad supera a tu saldo actual.";
        }
        return $mensaje;
    }
    public function __toString(){
        return
            "Número de cuenta: " . $this->getNumCuenta() . "\n" .
            "DNI del cliente: " . $this->getDniCliente() . "\n" .
            "Saldo actual: " . $this->getSaldoActual() . "\n" .
            "Interés anual: " . $this->getInteresAnual() . "\n" ;
    }
}
?>