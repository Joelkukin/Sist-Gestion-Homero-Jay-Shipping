<?php
    class Lista{
        protected $contenido = array();
        function __construct(Object ...$elementos){
            $this->contenido = $elementos;
        }
        function get_contenido(){
            return $this->contenido;
        }

        function agregar($elemento){
            array_push($this->contenido, $elemento);
            return $this->get_contenido();
        }


        public function buscar_propiedad(String $propiedad, $valor, $coincidencia_nro = 0) { // retorna array
            $resultados = []; // Array para almacenar los objetos encontrados
            foreach ($this->contenido as $objeto) {
                if ($objeto->$propiedad == $valor){
                    $resultados[] = $objeto;
                }
                return $resultados;
            }

            
            if($coincidencia_nro-1 < 0){
                return $resultados;
            }elseif($coincidencia_nro-1 >= 0){
                return $resultados[$coincidencia_nro-1];
            }else{
                if(count($resultados) == 1){
                    return $resultados[0]; // Devuelve el array con los objetos encontrados
                }
                return $resultados; // Devuelve el array con los objetos encontrados

            }
        }

        public function buscar_objeto(Object $objeto){ // retorna objeto
            $primer_coincidencia = array_search($objeto, $this->contenido);
            if($primer_coincidencia !== false){
                return $primer_coincidencia;
            }else{
                return null;
            }
        }

        function reemplazar (Array $objetos_viejos, Array $objetos_nuevos){ // retorna objetos reemplazados con éxito (...objects)
            # obtengo los objetos a reemplazar con sus respectivos indices
            $reemplazo = Array();
            $objetos_viejos = array_intersect_assoc($objetos_viejos);
            $lugares = array_keys($objetos_viejos);

            # reemplazo cada objeto viejo con cada objeto nuevo en sus respectivos lugares
            $i = 0;
            foreach ($objetos_viejos as $lugar => $objeto_viejo) {
                $reemplazo[$lugar] = $objetos_nuevos[$i];
                $i++;
            }

            $reemplazo = array_merge($reemplazo, array_diff(array_values($reemplazo),$objetos_nuevos));
            
            array_replace($this->contenido, $reemplazo);
        }


        function eliminar (...$objetivos){
            $resultado = array();
            foreach ($objetivos as $objetivo) {
                switch (gettype($objetivo)) {
                    case 'object':
                        $this->contenido = array_diff($this->contenido, $objetivos);
                        $resultado["resultado"][] = true;
                        $resultado["objetivo"][] = $objetivo;
                        break;
                    
                    case 'integer':
                        unset($this->contenido[$objetivo]);
                        $resultado["resultado"][] = true;
                        $resultado["objetivo"][] = $objetivo;
                        break;
                    
                    case 'string':
                        unset($this->contenido[$objetivo]);
                        $resultado["resultado"][] = true;
                        $resultado["objetivo"][] = $objetivo;
                        break;
                        
                    default:
                        $resultado["resultado"][] = false;
                        $resultado["objetivo"][] = $objetivo;
                        break;
                }
            }
            return $resultado;
        }
    }
    function test_lista(){
        $autopartes = new Lista(
            new Autoparte("motor"), 
            new Autoparte("transmision"),
            new Autoparte("rueda"),
            new Autoparte("rueda"),
            new Autoparte("rueda"),
            new Autoparte("rueda"),
            new Autoparte("chasis"),
            new Autoparte("freno"),
            new Autoparte("freno"),
            new Autoparte("freno")
        );
    
        
    
        
        $freno = new Autoparte("freno");
        $valor = "nombre";
        $propiedad = "nombre";
        var_dump($freno->$propiedad)."\n";
        
        print_r("<h3>Metodo ver</h3>");
        echo json_encode($autopartes->ver(), JSON_PRETTY_PRINT)."<br>";
        
        print_r("<h3>Metodo agregar</h3>");
        echo json_encode($autopartes->agregar(new Autoparte("freno")), JSON_PRETTY_PRINT)."<br>";
        
        print_r("<h3>Metodo buscar</h3>");
        echo json_encode($autopartes->buscar("nombre", "freno"), JSON_PRETTY_PRINT)."<br>";
    
        print_r("<h3>Metodo reemplazar</h3>");
        echo json_encode($autopartes->reemplazar($autopartes->buscar("nombre", "freno",2), new Autoparte("frBrandstorm")), JSON_PRETTY_PRINT)."<br><br>";
        
        print_r("<h3>Metodo eliminar</h3>");
        # typeof $arg = array
        echo json_encode($autopartes->eliminar($autopartes->buscar("nombre", "frBrandstorm")), JSON_PRETTY_PRINT)."<br>"; 
        echo "<br>".json_encode($autopartes->eliminar([9,8]), JSON_PRETTY_PRINT)."<br>"; 
        # typeof $arg = int
        echo "<br>".json_encode($autopartes->eliminar(9), JSON_PRETTY_PRINT)."<br>"; 
        # typeof $arg = obj
        echo "<br>".json_encode($autopartes->eliminar(new Autoparte("motor")), JSON_PRETTY_PRINT)."<br>"; 
    }
    
?>