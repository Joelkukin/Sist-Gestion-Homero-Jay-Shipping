<?php
include_once "./Autoparte.php";
include_once "./Ruta.php";
include_once "./Carga.php";


abstract class Vehiculo
{
    public $empresa; 
    public $matricula;
    public $capacidad;
    public $es_propio;
    public $es_refrigerado;
    public $carga;
    public $ruta;
    public $tipo_de_area;

    function __construct(String $empresa, String $matricula, int $capacidad, bool $es_propio, bool $es_refrigerado, String $tipo_de_area){
        
        $this->empresa = $empresa;
        $this->matricula = $matricula;
        $this->capacidad = $capacidad;
        $this->es_propio = $es_propio;
        $this->es_refrigerado = $es_refrigerado;
        $this->tipo_de_area = $tipo_de_area;
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
        # validar si tiene una carga asignada
        var_dump($carga);
        if(!isset($this->carga)){
            $this->carga = $carga;
        }else{
            echo "El vehiculo ya tiene una carga asignada";
        };
        # validar si la carga es para vehiculo refrigerado o no
        if($carga->es_refrigerado){
            if($this->es_refrigerado){
                $this->carga = $carga;
            }else{
                echo "El vehiculo no es refrigerado, no se puede asignar la carga";
            }
        }
        // Validar si la carga cabe en el camión
        if ($carga->ver_peso_total() > $this->capacidad) {
            throw new Exception("La carga no cabe en el camión. Peso total: " . $carga->ver_peso_total() . ", Capacidad del camión: " . $this->capacidad." kg.",1);
        }

        // Asignar la carga al camión
        $this->carga = $carga;
        return $this->carga;
    }

    public function asignar_ruta(Ruta $ruta) {
        # falta validar si ya tiene una ruta asignada o no
        if(!isset($this->ruta)){
            if($this->tipo_de_area == $ruta->tipo_de_area){
                $this->ruta = $ruta;
            }else{
                echo "El tipo de ruta no coincide con el tipo de camión";
            }
        }else{
            echo "El vehiculo ya tiene una ruta asignada";
        };
        
        return $this->ruta;
    }

    abstract function salir_a_reparto();
}

?>