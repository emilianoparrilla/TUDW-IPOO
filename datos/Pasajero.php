<?php

class Pasajero{
    private $nombre;
    private $apellido;
    private $doc;
    private $telefono;
    private $objViaje;
    private $msjOperacion;

    public function __construct(){
        $this->nombre="";
        $this->apellido="";
        $this->doc="";
        $this->telefono="";
        $this->objViaje = null;
    }

    public function cargarDatos($nombrePasajero,$apellidoPasajero,$documento,$numTelefono,$objViaje){
        $this->setNombre($nombrePasajero);
        $this->setApellido($apellidoPasajero);
        $this->setDoc($documento);
        $this->setTelefono($numTelefono);
        $this->setObjViaje($objViaje);
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
    public function getObjViaje(){
        return $this->objViaje;
    }
    public function getMsjOperacion(){
        return $this->msjOperacion;
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
    public function setObjViaje($objViaje){
        $this->objViaje = $objViaje;
    }
    public function setMsjOperacion($msjOperacion){
        $this->msjOperacion = $msjOperacion;
    }
    
    public function __toString(){
        return "DATOS PASAJERO: \n" .
            "NOMBRE: " . $this->getNombre() . "\n" .
            "APELLIDO: " . $this->getApellido() . "\n" .
            "DOCUMENTO: " . $this->getDoc() . "\n" .
            "TELEFONO: " . $this->getTelefono() . "\n" . $this->getObjViaje();
    }
    
    public function __destruct(){
        return $this . "Instancia destruida. No hay referencias a este objeto. \n\n";
    }

    /**
	 * Recupera los datos de un pasajero por dni
	 * @param int $dni;
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function buscarPasaj($dni){
		$base = new BaseDatos();
		$consultaPasajero = "Select * from pasajero where rdocumento=" . $dni;
		$respuesta = false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPasajero)){
				if($row=$base->Registro()){
				    $this->setDoc($dni);
					$this->setNombre($row['pnombre']);
					$this->setApellido($row['papellido']);
					$this->setTelefono($row['ptelefono']);

					$IdViaje = $row['idviaje'];
					
					$objViaje = new Viaje();
					$objViaje->setIdViaje($IdViaje);					
                    $this->setObjViaje($objViaje);
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

    public function listarPasaj($condicion=""){
	    $aPasajero = null;
		$base = new BaseDatos();
		$consultaPasajero = "Select * from pasajero ";
		if ($condicion != ""){
		    $consultaPasajero = $consultaPasajero . ' where '. $condicion;
		}
		$consultaPasajero .= " order by papellido ";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPasajero)){
				$aPasajero = [];
				while($row=$base->Registro()){
					$Doc = $row['rdocumento'];
				
					$objPasajero = new Pasajero();
					$objPasajero->buscarPasaj($Doc);
					array_push($aPasajero,$objPasajero);
				}
		 	}else{
		 		$this->setMsjOperacion($base->getError());		 		
			}
		 }else{
		 	$this->setMsjOperacion($base->getError());		 	
		 }	
		 return $aPasajero;
	}

    public function insertarPasaj(){
		$base = new BaseDatos();
		$respuesta = false;
		$idViaje = $this->getObjViaje()->getIdViaje();		
		$consultaInsertar = "INSERT INTO pasajero(rdocumento, pnombre, papellido, ptelefono, idviaje) 
				VALUES ('" . $this->getDoc() . "','" . $this->getNombre(). "','" . $this->getApellido() . "'," . $this->getTelefono() . "," . $idViaje . ")";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaInsertar)){
			    $respuesta = true;
			}else{
				$this->setMsjOperacion($base->getError());					
			}
		}else{
			$this->setMsjOperacion($base->getError());			
		}
		return $respuesta;
	}

    public function modificarPasaj(){
	    $respuesta = false; 
	    $base = new BaseDatos();
		$idViaje = $this->getObjViaje()->getIdViaje();
		$consultaModifica = "UPDATE pasajero SET pnombre='" . $this->getNombre() . "',papellido='" . $this->getApellido() . "'
                           ,ptelefono=" . $this->getTelefono() . ",idviaje=" . $idViaje . " WHERE rdocumento='" . $this->getDoc() . "'";
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

    public function eliminarPasaj(){
		$base = new BaseDatos();
		$respuesta = false;
		if($base->Iniciar()){
				$consultaBorra = "DELETE FROM pasajero WHERE rdocumento = " . $this->getDoc();
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