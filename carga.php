<?php

include_once "./Producto.php" ;
include_once "./Lista.php" ;

class Carga extends Lista{
    public $productos; // Array de productos
    private $peso_total = 0; // Suma de los pesos totales de los productos
    public $es_refrigerado; 
    
    function __construct(Producto ...$productos) {
        foreach ($productos as $producto) {
            $this->peso_total += $producto->peso_total;
            $this->contenido[] = $producto;
            if($producto->es_refrigerado){
                $this->es_refrigerado = true;
            }
        }
        $this->productos = $this->contenido;
    }

    // Método para agregar un producto
    public function agregar_producto(Producto ...$productos) {
        foreach ($productos as $producto) {
            array_push($this->productos, $producto);
            $this->peso_total += $producto->peso_total;
        }
    }
    
    public function ver_peso_total() {
        return $this->peso_total;
    }

    // Método para mostrar información de la carga
    public function mostrar_informacion() {
        echo "Peso Total de la Carga: " . $this->peso_total . " kg<br>";
        foreach ($this->productos as $producto) {
            $producto->mostrar_informacion();
            echo "<br>";
        }
    }
}

function test_carga()  {
// Crear instancia de la clase Producto y Carga
$producto1 = new Producto("Helado1", 10, 3, true);
$producto2 = new Producto("Helado2", 5, 3, true);
$producto3 = new Producto("Chocolate", 20, 1, false);

$carga = new Carga(
    $producto1,
    $producto2,
    $producto3
);

// Mostrar información de la carga
//$carga->mostrar_informacion();
print_r($carga->productos); print_r( "<br><br>" );
print_r($carga->peso_total); print_r( "<br><br>" );
print_r($carga->es_refrigerado); print_r( "<br><br>" );}
?>