<?php

class Autoparte {
    private $nombre;
    private $desgaste;

    public function __construct($nombre) {
        if (empty($nombre)) {
            throw new Exception("El nombre de la autopieza no puede estar vacío");
        }
    
        if (!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/', $nombre)) {
            throw new Exception("El nombre de la autopieza solo puede contener caracteres alfanuméricos, guiones bajos y espacios");
        }
    
        $this->nombre = $nombre;
        $this->desgaste = 0;
    }
    
    // Restaura el desgaste a 0 (como nuevo).
    public function cambiar() {
        $this->desgaste = 0;
    }
    // Aumenta el desgaste en 1.
    public function usar() {
        if ($this->desgaste < 0) {
            throw new Exception("El desgaste de la autopieza no puede ser negativo");
        }
    
        $this->desgaste++;
    }
     // Getters
     public function getNombre() {
        return $this->nombre;
    }

    public function getDesgaste() {
        return $this->desgaste;
    }
}   
    // Crear instancia de prueba
    $motor = new Autoparte("motor");

    // Verificar nombre y desgaste
    echo "Nombre: " . $motor->getNombre() . "\n";
    echo "Desgaste: " . $motor->getDesgaste() . "\n";

    // Usar la autopieza y verificar el desgaste
    $motor->usar();
    echo "Desgaste después de usar: " . $motor->getDesgaste() . "\n";

    // Cambiar la autopieza y verificar el desgaste
    $motor->cambiar();
    echo "Desgaste después de cambiar: " . $motor->getDesgaste() . "\n";

?>