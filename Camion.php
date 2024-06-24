<?php
include_once "./autoparte.php";
include_once "./lista.php";
include_once "./direccion.php";

class Camion extends Vehiculo {

    private $capacidad;
    public $ruta;

    public function __construct($empresa, $matricula, $capacidad, $autopartes = []) {
        parent::__construct($empresa, $matricula, $propio);
        # si no recibo autopartes por parametro es porque el camion no es propio de nuestra empresa
        if(count($autopartes) == 0){
            $this->propio = false;
        } else {
            $this->propio = true;
            $this->autopartes = new Lista($autopartes);
        }
        $this->capacidad = $capacidad;
    }

    public function getCapacidad() {
        return $this->capacidad;
    }

    public function getAutopartes() {
        return $this->autopartes;
    }

    public function addAutoparte(Autoparte $autoparte) {
        $this->autopartes[] = $autoparte;
    }

    public function removeAutoparte(Autoparte $autoparte) {
        $key = array_search($autoparte, $this->autopartes);
        if ($key !== false) {
            unset($this->autopartes[$key]);
        }
        $this->autopartes->reemplazar($autoparte);
    }

    public function asignarCarga(Carga $carga) {
        // Validar si la carga cabe en el camión
        if ($carga->getPesoTotal() > $this->getCapacidad()) {
            throw new Exception("La carga no cabe en el camión. Peso total: " . $carga->getPesoTotal() . ", Capacidad del camión: " . $this->getCapacidad());
        }

        // Asignar la carga al camión
        $this->carga = $carga;
    }

    public function asignarRuta(Direccion ...$ruta) {
        $this->ruta = new Lista($ruta);
    }

    public function salir_a_reparto() {
        $this->ruta;
        $this->carga;
        foreach($autopartes as $autoparte){
            $autoparte->usar;
        }
    }

    public function realizarMantenimiento() {

        // Cambiar las autopartes desgastadas
        foreach ($this->getAutopartes() as $autoparte) {
            if ($autoparte->getDesgaste() >= 100) {
                $this->removeAutoparte($autoparte);
            }
        }
    }
}

$camion = new Camion($empresa, $matricula, $capacidad, $autopartes = []);

var_dump($camion->getCapacidad());
var_dump($camion->setCapacidad($capacidad));
var_dump($camion->getAutopartes());
var_dump($camion->addAutoparte(Autoparte $autoparte));
var_dump($camion->removeAutoparte(Autoparte $autoparte));
var_dump($camion->asignarCarga(Carga $carga));
var_dump($camion->asignarRuta(Ruta $ruta));
var_dump($camion->realizarMantenimiento());
