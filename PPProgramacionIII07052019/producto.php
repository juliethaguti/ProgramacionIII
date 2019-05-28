<?php
class Producto{
    private $id;
    private $nombre;
    private $precio;
    private $imagen;
    private $usuario;

    function __construct($id,$nombre,$precio,$imagen,$usuario){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->usuario = $usuario;
        
        $ext = array_reverse(explode(".",$imagen["name"]));
        $this->imagen = $this->nombre.".".$ext[0];
        move_uploaded_file($imagen["tmp_name"],"./ImagenProductos/".$this->imagen);
    }

    public function __toString(){
        return $this->id.",".$this->nombre.",".$this->precio.",".$this->usuario.",./ImagenProductos/"
        .$this->imagen.PHP_EOL;
    }

    static function nuevoId($lista){
        
        $id = -1;
        if($lista == 0){
            $id = 1;
        }else{
            foreach($lista as $producto){
                $arrayAtributos = explode(",",$producto);
               
                if($id < $arrayAtributos[0]){
                    $id =$arrayAtributos[0];
                    $id++;
                }
            }
        }
        return $id+1;
    }

    static function listarProductosByUsuario($usuario,$lista){
        foreach($lista as $item){
            $atributosProducto = explode(",",$item);
            if($atributosProducto[3] == $usuario){
                echo($item);
            }
        }
    }

    static function listarProductosByProducto($producto,$lista){
        foreach($lista as $item){
            $atributosProducto = explode(",",$item);
            if($atributosProducto[1] == $producto){
                echo($item);
            }
        }
    }

    static function obtenerRegistro($id,$array){
        
        foreach($array as $objeto){
            
            if($id == $objeto[0]){
                  
                return $objeto;
            }
        }
        return null;
    }

    function modificar($array,$nuevaEntidad,$registro){
        
        for($i = 0;$i<count($array);$i++){
            if($array[$i] == $registro){
                $array[$i] = $nuevaEntidad->__toString();
                break;
            }
        }
        return $array;
    }
}
?>