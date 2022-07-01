<?php

class Responsable{
    private $numEmpleado;
    private $numLicencia;
    private $nombre;
    private $apellido;    
    private $msjOperacion;

    public function __construct(){
        $this->numEmpleado = 0;
        $this->numLicencia = "";
        $this->nombre = "";
        $this->apellido = "";        
    }

    public function cargarDatos($numeroLicencia,$nombreResponsable,$apellidoResponsable){
        $this->setNumLicencia($numeroLicencia);
        $this->setNombre($nombreResponsable);
        $this->setApellido($apellidoResponsable);        
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
    public function getMsjOperacion(){
        return $this->msjOperacion;
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
    public function setMsjOperacion($msjOperacion){
        $this->msjOperacion = $msjOperacion;
    }

    public function __toString(){
        return "DATOS RESPONSABLE VIAJE:" .
                "\nNUMERO DE EMPLEADO: " . $this->getNumEmpleado() .
                "\nNUMERO DE LICENCIA: " . $this->getNumLicencia() .
                "\nNOMBRE: " . $this->getNombre() .
                "\nAPELLIDO: " . $this->getApellido() . "\n\n";                
    }
    public function __destruct(){
        return $this . "Instancia destruida. No hay referencias a este objeto. \n\n";
    }

    /**
	 * Recupera los datos de un responsable por número de empleado
	 * @param int $numE;
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function buscarResp($numE){
		$base = new BaseDatos();
		$consultaResponsable = "Select * from responsable where rnumeroempleado=" . $numE;
		$respuesta = false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaResponsable)){
				if($row=$base->Registro()){
				    $this->setNumEmpleado($numE);
					$this->setNumLicencia($row['rnumerolicencia']);
					$this->setNombre($row['rnombre']);
					$this->setApellido($row['rapellido']);
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

    public function listarResp($condicion=""){
	    $aResponsable = null;
		$base = new BaseDatos();
		$consultaResponsable = "Select * from responsable ";
		if ($condicion != ""){
		    $consultaResponsable = $consultaResponsable . ' where ' . $condicion;
		}
		$consultaResponsable .= " order by rapellido ";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaResponsable)){
				$aResponsable = array();
				while($row = $base->Registro()){					
					$NumEmpleado = $row['rnumeroempleado'];
					$objResponsable = new Responsable();
					$objResponsable->buscarResp($NumEmpleado);
					array_push($aResponsable,$objResponsable);
				}							
		 	}else{
		 		$this->setMsjOperacion($base->getError());		 		
			}
		 }else{
		 	$this->setMsjOperacion($base->getError());		 	
		 }	
		 return $aResponsable;
	}

    public function insertarResp(){
		$base = new BaseDatos();
		$respuesta = false;
		$consultaInsertar = "INSERT INTO responsable(rnumerolicencia, rnombre,  rapellido) 
				VALUES (" . $this->getNumLicencia().",'" . $this->getNombre() . "','" . $this->getApellido() . "')";
		if($base->Iniciar()){
			if($nroEmpleado = $base->devuelveIDInsercion($consultaInsertar)){
				$this->setNumEmpleado($nroEmpleado);
			    $respuesta = true;
			}else{
				$this->setMsjOperacion($base->getError());					
			}
		}else{
			$this->setMsjOperacion($base->getError());			
		}
		return $respuesta;
	}

    public function modificarResp(){
	    $respuesta = false; 
	    $base = new BaseDatos();
		$consultaModifica = "UPDATE responsable SET rnumerolicencia='" . $this->getNumLicencia() . "',rnombre='" . $this->getNombre() . "'
                           ,rapellido='" . $this->getApellido() . "' WHERE rnumeroempleado=" . $this->getNumEmpleado();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $respuesta=  true;
			}else{
				$this->setMsjOperacion($base->getError());				
			}
		}else{
			$this->setMsjOperacion($base->getError());			
		}
		return $respuesta;
	}

    public function eliminarResp(){
		$base = new BaseDatos();
		$respuesta = false;
		if($base->Iniciar()){
				$consultaBorra = "DELETE FROM responsable WHERE rnumeroempleado = " . $this->getNumEmpleado();
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