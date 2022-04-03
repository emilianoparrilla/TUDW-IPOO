<?php
class Login{
    private $nombreUsuario;
    private $contrasenia;
    private $frase;
    private $arrayContrasenias = [" ", " ", " ", " "];

    public function __construct($nombre, $pass, $fraseAyuda, $ultimasContraseñas){
        $this->nombreUsuario = $nombre;
        $this->contrasenia = $pass;
        $this->frase = $fraseAyuda;
        $this->arrayContrasenias = $ultimasContraseñas;
    }
    public function getNombreUsuario(){
        return $this->nombreUsuario;
    }
    public function getContrasenia(){
        return $this->contrasenia;
    }
    public function getFrase(){
        return $this->frase;
    }
    public function getArrayContrasenias(){
        return $this->arrayContrasenias;
    }
    public function setNombreUsuario($nombre){
        $this->nombreUsuario = $nombre;
    }
    public function setContrasenia($pass){
        $this->contrasenia = $pass;
    }
    public function setfrase ($fraseAyuda){
        $this->frase = $fraseAyuda;
    }
    public function setArrayContrasenias($ultimasContraseñas){
        $this->arrayContrasenias = $ultimasContraseñas;
    }
    /**
     * Esta función permite validar si una contraseña ingresada es correcta o no. Siendo 
     * incorrecta, se valida también si coincide con alguna de las contraseñas viejas.
     * @param string $passAValidar
     * @return string
     */
    public function validar($passAValidar){
        $esVieja = false;
        $i = 0;
        if ($this->getContrasenia() != $passAValidar){
            while ($i <= 3 && $esVieja == false){
                if ($this->getArrayContrasenias()[$i] == $passAValidar){
                    $esVieja = true;
                    $strValidacion = "La contraseña es antigua. Ingrese nuevamente.\n\n";
                }
                $i = $i + 1;
            }
            if ($esVieja == false){
                $strValidacion = "La contraseña es incorrecta.\n\n";
            }
        }
        else{
            $strValidacion = "La contraseña ingresada es correcta. \n\n";
        }
        return $strValidacion;
    }
    /**
     * Esta función permite cambiar la contraseña a partir del ingreso de un parámetro.
     * @param string $nuevaContrasenia
     * @return string
     */
    public function cambiarContrasenia($nuevaContrasenia){
        $esAntigua = false;
        $i = 0;
        while ($i <= 3 && $esAntigua == false){
            if ($this->getArrayContrasenias()[$i] == $nuevaContrasenia){
                $esAntigua = true;
                $strCambio = "La contraseña es antigua. Por favor, ingrese una nueva. \n\n";
            }
            $i = $i + 1;
        }
        if ($esAntigua == false){
            //Se ordenan automáticamente las contraseñas antiguas.
            $arrayPassViejas[0] = $this->getContrasenia();
            for ($i=0; $i<3; $i++){
                $arrayPassViejas[$i + 1] = $this->getArrayContrasenias()[$i];
            }
            $this->setArrayContrasenias($arrayPassViejas);
            $this->setContrasenia($nuevaContrasenia);
            $strCambio = "La contraseña se cambió correctamente. \n\n";
        }
        return $strCambio;
    }
    /**
     * Este módulo permite, a partir del ingreso correcto del nombre de usuario por parámetro,
     * mostrar la frase que permite recordar la contraseña.
     * @param $usuarioIngresado
     * return string
     */
    public function recordar($usuarioIngresado){        
        if ($usuarioIngresado == $this->getNombreUsuario()){
            $ayuda = $this->getFrase() . "\n\n";        
        }
        else{
            $ayuda = "El usuario ingresado no es correcto. \n\n";    
        }
        return $ayuda;
    }
    public function __toString(){
        $usuarioAct = $this->getNombreUsuario();
        $passAct = $this->getContrasenia();
        $fraseAct = $this->getFrase();
        $arrayPassAct = $this->getArrayContrasenias();
        return "Usuario: " . $usuarioAct . "\n" .  
                "Contraseña: " . $passAct . "\n" . 
                "Frase: " . $fraseAct . "\n" . 
                "Últimas contraseñas: " . $arrayPassAct[0] . " " . $arrayPassAct[1] . " " .
                                  $arrayPassAct[2] . " " . $arrayPassAct[3] . "\n\n";
    }
    public function __destruct(){
        echo $this . "Instancia destruida. No hay referencias a este objeto. \n";
    }
}
?>