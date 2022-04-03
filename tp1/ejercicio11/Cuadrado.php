<?php
class Cuadrado{
    private $vertice1;
    private $vertice2;
    private $vertice3;
    private $vertice4;
    public function __construct($v1, $v2, $v3, $v4){
        $this->vertice1 = $v1;
        $this->vertice2 = $v2;
        $this->vertice3 = $v3;
        $this->vertice4 = $v4;
    }
    public function getVertice1(){
        return $this->vertice1;
    }
    public function getVertice2(){
        return $this->vertice2;
    }
    public function getVertice3(){
        return $this->vertice3;
    }
    public function getVertice4(){
        return $this->vertice4;
    }
    public function setVertice1($v1){
        $this->vertice1 = $v1;
    }
    public function setVertice2($v2){
        $this->vertice2 = $v2;
    }
    public function setVertice3($v3){
        $this->vertice3 = $v3;
    }
    public function setVertice4($v4){
        $this->vertice4 = $v4;
    }
    public function area(){
        $lado = $this->getVertice2()['y'] - $this->getVertice1()['y'];
        $calculoArea = pow($lado, 2);
        return $calculoArea;
    }
    /**
     * Esta función recibe un punto por parámetro y desplaza el cuadrado hacia el mismo desde
     * su vértice inferior izquierdo.
     * @param $array $d
     */
    public function desplazar($d){
        //Calculo distancia en x e y que se desplaza cada vértice (es igual para todos).
        $distanciaX = $d['x'] - $this->getVertice1()['x'];
        $distanciaY = $d['y'] - $this->getVertice1()['y'];
        echo "Distancias: " . $distanciaX . "," . $distanciaY . "\n";
        //Modifico coordenadas del vértice 1:
        $vert1x = $this->getVertice1()['x'];
        $vert1y = $this->getVertice1()['y'];
        $arrayV1 = ['x'=> ($vert1x + $distanciaX), 'y'=> ($vert1y + $distanciaY)];
        $this->setVertice1($arrayV1);
        //Modifico coordenadas del vértice 2:
        $vert2x = $this->getVertice2()['x'];
        $vert2y = $this->getVertice2()['y'];
        $arrayV2 = ['x'=> ($vert2x + $distanciaX), 'y'=> ($vert2y + $distanciaY)];
        $this->setVertice2($arrayV2);
        //Modifico coordenadas del vértice 3:
        $vert3x = $this->getVertice3()['x'];
        $vert3y = $this->getVertice3()['y'];
        $arrayV3 = ['x'=> ($vert3x + $distanciaX), 'y'=> ($vert3y + $distanciaY)];
        $this->setVertice3($arrayV3);
        //Modifico  coordenadas del vértice 4:
        $vert4x = $this->getVertice4()['x'];
        $vert4y = $this->getVertice4()['y'];
        $arrayV4 = ['x'=> ($vert4x + $distanciaX), 'y'=> ($vert4y + $distanciaY)];
        $this->setVertice4($arrayV4);
    }
    /**
     * Esta función recibe el valor de un lado mayor al actual, con el cual se aumentará 
     * el tamaño del mismo (tomando como referencia el primer vértice).
     * @param int $t
     */
    public function aumentarTamaño($t){
        //Como tomamos como referencia el primer vértice, el mismo no es necesario modificarlo.
        //Desplazo el vértice 2 en y:
        $v2x = $this->getVertice2()['x'];
        $v2y = $this->getVertice1()['y'];
        $nuevoV2 = ['x'=>$v2x, 'y'=> ($v2y + $t)];
        $this->setVertice2($nuevoV2);
        //Desplazo el vértice 3 en x e y respectivamente:
        $v3x = $this->getVertice2()['x'];
        $v3y = $this->getVertice1()['y'];
        $nuevoV3 = ['x'=>($v3x + $t), 'y'=> ($v3y + $t)];
        $this->setVertice3($nuevoV3);
        //Desplazo el vértice 4 en x:
        $v4x = $this->getVertice1()['x'];
        $v4y = $this->getVertice4()['y'];
        $nuevoV4 = ['x'=>($v4x + $t), 'y'=> ($v4y)];
        $this->setVertice4($nuevoV4);
    }
    public function __toString(){
        return 
            "p1x = " . $this->getVertice1()['x'] . " p1y = " . $this->getVertice1()['y'] . "\n" .
            "p2x = " . $this->getVertice2()['x'] . " p2y = " . $this->getVertice2()['y'] . "\n" .
            "p3x = " . $this->getVertice3()['x'] . " p3y = " . $this->getVertice3()['y'] . "\n" . 
            "p4x = " . $this->getVertice4()['x'] . " p4y = " . $this->getVertice4()['y'] . "\n\n";
    }
    public function __destruct(){
        echo $this . "Instancia destruida. No hay referencias a este objeto.\n";
    }
}
?>