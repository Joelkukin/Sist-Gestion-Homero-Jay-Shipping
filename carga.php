<?php

include_once "./producto.php" ;
include_once "./lista.php" ;

class Carga extends Lista{
    public $productos; // Array de productos
    public $peso_total; // Suma de los pesos totales de los productos
    public $refrigerado; 
    
    function __construct(...$productos) {
        $this->clasificar_productos($productos);
        $this->productos = $productos;
        $this->peso_total = 0;
        $this->actualizar_peso_total();
    }

    // Método para agregar un producto
    public function agregar_producto($producto) {
        array_push($this->productos, $producto);
        $this->actualizar_peso_total();
    }

    // Método para calcular el peso total
    private function actualizar_peso_total() {
        
        foreach ($this->productos as $producto) {
            $this->peso_total += $producto->peso_total;
        }
    }

    // Método para clasificar productos
    public function clasificar_productos($productos) {
        # verifica si en algun elemento del array tiene la propiedad refrigerado == true 
        foreach ($productos as $producto) {
            if($producto->refrigerado) {$this->refrigerado = true;}
        }
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
print_r($carga->refrigerado); print_r( "<br><br>" );
?>