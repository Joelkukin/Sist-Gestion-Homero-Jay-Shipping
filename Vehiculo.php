<?php
include_once "./Autoparte.php";


abstract class Vehiculo
{
    public $empresa; 
    public $matricula;
    public $capacidad;
    public $propio;
    public $carga;
    public $ruta;

    function __construct(String $empresa, String $matricula, int $capacidad, bool $refrigerado){
        
        $this->$empresa = $empresa;
        $this->$matricula = $matricula;
        $this->$capacidad = $capacidad;
        $this->$refrigerado = $refrigerado;
    }
    
    public function ver_empresa (){
        return $this->empresa;
    }
    public function ver_matricula(){
        return $this->matricula;
    }
    public function ver_capacidad (){
        return $this->capacidad;
    }
    public function realizar_mantenimiento (){
        $autopartes = $this->autopartes->get_contenido();
        foreach ($autopartes as $autoparte){
            $autoparte->cambiar();
        }
    }

    public function asignar_carga(Carga $carga) {
        // Validar si la carga cabe en el camión
        if ($carga->ver_peso_total() > $this->capacidad) {
            throw new Exception("La carga no cabe en el camión. Peso total: " . $carga->ver_peso_total() . ", Capacidad del camión: " . $this->capacidad." kg.",1);
        }

        // Asignar la carga al camión
        $this->carga = $carga;
        return $this->carga;
    }

    public function asignar_ruta(Direccion ...$ruta) {
        # falta validar si ya tiene una ruta asignada o no
        $this->ruta = new Lista(...$ruta);
        return $this->ruta;
    }

    abstract function salir_a_reparto();
}

?>