<?php

class Viaje{
    private $idViaje;
    private $destino;
    private $maxPasajeros;
    private $coleccionPasajeros;
    private $objResponsable;
    private $objEmpresa;
    private $importe;
    private $tipoAsiento;
    private $idaVuelta;
    private $msjOperacion;

    public function __construct(){
        $this->idViaje = 0;
        $this->destino = "";
        $this->maxPasajeros = "";
        $this->coleccionPasajeros = [];
        $this->objResponsable = null;
        $this->objEmpresa = null;
        $this->importe = "";
        $this->tipoAsiento = "";
        $this->idaVuelta = "";
    }

    public function cargarDatos($destinoViaje,$maxCantPasajeros,$objResponsableViaje,$objEmpresa,$importe,$tipoAsiento,$idaVuelta){
        $this->setDestino($destinoViaje);
        $this->setMaxPasajeros($maxCantPasajeros);
        $this->setObjResponsable($objResponsableViaje);
        $this->setObjEmpresa($objEmpresa);
        $this->setImporte($importe);
        $this->setTipoAsiento($tipoAsiento);
        $this->setIdaVuelta($idaVuelta);
    }

    //Se implementan los métodos de acceso.
    public function getIdViaje(){
        return $this->idViaje;
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
    public function getObjEmpresa(){
        return $this->objEmpresa;
    }
    public function getImporte(){
        return $this->importe;
    }
    public function getTipoAsiento(){
        return $this->tipoAsiento;
    }
    public function getIdaVuelta(){
        return $this->idaVuelta;
    }
    public function getMsjOperacion(){
        return $this->msjOperacion;
    }
    public function setIdViaje($codigoViaje){
        $this->idViaje = $codigoViaje;
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
    public function setObjEmpresa($objEmpresa){
        $this->objEmpresa = $objEmpresa;
    }
    public function setImporte($importe){
        $this->importe = $importe;
    }
    public function setTipoAsiento($tipoAsiento){
        $this->tipoAsiento = $tipoAsiento;
    }
    public function setIdaVuelta($idaVuelta){
        $this->idaVuelta = $idaVuelta;
    }
    public function setMsjOperacion($msjOperacion){
        $this->msjOperacion = $msjOperacion;
    }

    public function mostrarIdaVuelta(){
        $esIdaVuelta = $this->getIdaVuelta();
        $str = $esIdaVuelta ? "SI" : "NO";
        return $str;
    }
        
    public function mostrarDatosPasajeros(){
        $coleccionTotal = $this->getColeccionPasajeros();
        $strMostrar = "COLECCION PASAJEROS: \n";
        foreach ($coleccionTotal as $i=>$objInfoPasajero){            
            $strMostrar .= "[" . ($i+1) . "]: \n";
            $strMostrar .= $objInfoPasajero;
        }
        return $strMostrar;
    }
    public function __toString(){
        $strColeccion = $this->mostrarDatosPasajeros();
        return  "DATOS VIAJE: " .
                "\nID DE VIAJE: " . $this->getIdViaje() . 
                "\nDESTINO: " . $this->getDestino() . 
                "\nCANTIDAD MAXIMA DE PASAJEROS: " . $this->getMaxPasajeros() .
                "\nIMPORTE: "  . $this->getImporte() .
                "\nTIPO DE ASIENTO: " . $this->getTipoAsiento() .
                "\nES IDA Y VUELTA: " . $this->mostrarIdaVuelta() . "\n" .
                $this->getObjResponsable() . $this->getObjEmpresa() . $strColeccion;
    }
    
    public function __destruct(){
        return $this . "Instancia destruida. No hay referencias a este objeto.";
    }

    /**
	 * Recupera los datos de un viaje por id de viaje
	 * @param int $idViaje;
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function buscarViaje($idViaje){
		$base = new BaseDatos();
		$consultaViaje = "Select * from viaje where idviaje=" . $idViaje;
		$respuesta = false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaViaje)){
				if($row=$base->Registro()){
				    $this->setIdViaje($idViaje);
					$this->setDestino($row['vdestino']);
					$this->setMaxPasajeros($row['vcantmaxpasajeros']);

                    $objPasajero = new Pasajero();
                    $arrayPasajeros = $objPasajero->listarPasaj("idviaje=" . $this->getIdViaje());
                    $this->setColeccionPasajeros($arrayPasajeros);

                    $NumEmpleado = $row['rnumeroempleado'];
                    $objResponsable = new Responsable();
                    $objResponsable->buscarResp($NumEmpleado);
                    $this->setObjResponsable($objResponsable);

                    $IdEmpresa = $row['idempresa'];
                    $objEmpresa = new Empresa();
                    $objEmpresa->buscarEmp($IdEmpresa);
                    $this->setObjEmpresa($objEmpresa);

					$this->setImporte($row['vimporte']);
                    $this->setTipoAsiento($row['tipoAsiento']);
                    if ($row['idayvuelta'] == "SI"){
                        $this->setIdaVuelta(true);
                    } else{
                        $this->setIdaVuelta(false);
                    }
					$respuesta = true;
				}
		 	}else{
		 		$this->setMsjOperacion($base->getError());		 		
			}
		 }else{
		 	$this->setMsjOperacion($base->getError());		 	
		 }		
		 return $respuesta;
	}

    public function listarViajes($condicion=""){
	    $aViaje = null;
		$base = new BaseDatos();
		$consultaViaje = "Select * from viaje ";
		if ($condicion != ""){
		    $consultaViaje = $consultaViaje . ' where '. $condicion;
		}
		$consultaViaje .= " order by idviaje ";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaViaje)){
				$aViaje = array();
				while($row = $base->Registro()){
					$IdViaje = $row['idviaje'];
					$objViaje = new Viaje();
					$objViaje->buscarViaje($IdViaje);
					array_push($aViaje,$objViaje);
				}                
		 	}else{
		 		$this->setMsjOperacion($base->getError());		 		
			}
		 }else{
		 	$this->setMsjOperacion($base->getError());		 	
		 }	
		 return $aViaje;
	}

    public function insertarViaje(){
		$base = new BaseDatos();
		$respuesta = false;
        $IdEmpresa = $this->getObjEmpresa()->getIdEmpresa();
		$consultaInsertar = "INSERT INTO viaje(vdestino, vcantmaxpasajeros,  idempresa, rnumeroempleado, vimporte, tipoAsiento, idayvuelta) 
				VALUES ('" . $this->getDestino()."'," . $this->getMaxPasajeros() . "," . $IdEmpresa . 
                    "," . $this->getObjResponsable()->getNumEmpleado() . "," . $this->getImporte() . ",'" . $this->getTipoAsiento() . "','" . $this->mostrarIdaVuelta() . "')";                    
		if($base->Iniciar()){
			if($idViaje = $base->devuelveIDInsercion($consultaInsertar)){
				$this->setIdViaje($idViaje);                
			    $respuesta = true;
			}else{
				$this->setMsjOperacion($base->getError());					
			}
		}else{
			$this->setMsjOperacion($base->getError());
		}
		return $respuesta;
	}

    public function modificarViaje(){
	    $respuesta = false;
	    $base = new BaseDatos();
        $IdEmpresa = $this->getObjEmpresa()->getIdEmpresa();
		$consultaModifica = "UPDATE viaje SET vdestino='" . $this->getDestino() . "',vcantmaxpasajeros=" . $this->getMaxPasajeros() . ",idempresa=" . $IdEmpresa . 
                            ",rnumeroempleado=" . $this->getObjResponsable()->getNumEmpleado() . ",vimporte=" . $this->getImporte() . ",tipoAsiento='" . $this->getTipoAsiento() . 
                            "',idayvuelta='" . $this->mostrarIdaVuelta() . "' WHERE idviaje=" . $this->getIdViaje();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $respuesta = true;
			}else{
				$this->setMsjOperacion($base->getError());				
			}
		}else{
			$this->setMsjOperacion($base->getError());			
		}
		return $respuesta;
	}

    public function eliminarViaje(){
		$base = new BaseDatos();
		$respuesta = false;
		if($base->Iniciar()){
				$consultaBorra = "DELETE FROM viaje WHERE idviaje = " . $this->getIdViaje();
				if($base->Ejecutar($consultaBorra)){
				    $respuesta = true;
				}else{
					$this->setMsjOperacion($base->getError());					
				}
		}else{
			$this->setMsjOperacion($base->getError());			
		}
		return $respuesta; 
	}

}
?>