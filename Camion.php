<?php #Lucas

include_once "./VehiculoTercerizado.php";
include_once "./VehiculoPropio.php";

# testear en archivo a parte llamado test_clase.php

class Camion { # hay que heredar de clase vehiculo con extends
    private $vehiculoPropio;
    private $vehiculoTercerizado;
    private $carga;

    public function __construct($empresa, $matricula, $capacidad, $propio) {

        #si propio es true, se agrega la propiedad autopartes y se crean sus instancias
        if($propio){
            $this->autopartes = new Lista(
                new Autoparte("motor"),
                new Autoparte("transmision"),
                new Autoparte("chasis"),
                new Autoparte("carroceria"),
                new Autoparte("container"),
                new Autoparte("rueda_del_izq"),
                new Autoparte("rueda_del_der"),
                new Autoparte("rueda_tra_izq"),
                new Autoparte("rueda_tra_der")
            );
        }
        # agregar instancias de  autopartes
        $this->vehiculoPropio = new VehiculoPropio($empresa, $matricula, $capacidad, $autopartes); # quitar
        $this->vehiculoTercerizado = new VehiculoTercerizado($empresa, $matricula, $capacidad); # quitar
        $this->carga = []; 
    }

    public function asignar_carga($productos) {
        try {
            foreach ($productos as $producto) {
                // Validación de tipo de dato para $producto
                if (!$producto instanceof Producto) {
                    throw new Exception("El parámetro $productos debe ser un array de objetos Producto.");
                }

                $this->carga[] = $producto;
            }
        } catch (Exception $e) {
            echo "No se pudo asignar la carga: " . $e->getMessage();
        }
    }

    public function asignar_carga_productos_refrigerados($productos_refrigerados) {
        try {
            foreach ($productos_refrigerados as $producto_refrigerado) {
                // Validación de tipo de dato para $producto_refrigerado
                if (!$producto_refrigerado instanceof Producto) {
                    throw new Exception("El parámetro $productos_refrigerados debe ser un array de objetos Producto.");
                }

                $this->carga[] = $producto_refrigerado;
            }
        } catch (Exception $e) {
            echo "No se pudo asignar la carga: " . $e->getMessage();
        }
    }
}
?>