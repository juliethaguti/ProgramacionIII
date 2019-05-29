<?php
class Pizza{
    private $precio;
    private $tipo;
    private $cantidad;
    private $sabor;
    private $id;
    private $imagen;

    function __construct($precio,$tipo,$cantidad,$sabor,$id,$imagen){
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;
        $this->sabor = $sabor;
        $this->id = $id;

        $ext = array_reverse(explode(".",$imagen["name"]));
        $this->imagen = $this->sabor.".".$ext[0];
        move_uploaded_file($imagen["tmp_name"],"./ImagenPizza/".$this->imagen);
    }

    function __toString(){
        return $this->id.",".$this->sabor.",".$this->tipo.",".$this->precio.",".$this->cantidad.",".$this->imagen.PHP_EOL;
    }

    function ToJson(){
        return json_encode(explode(",",$this),JSON_FORCE_OBJECT);
    }

    function decodeJson(){
        $retorno = json_decode($this,true);
        return $retorno;
    }

    function ocurrenciasTipoSabor($list,$tipo,$sabor){
        $flag = false;
        foreach($list as $pizza){
            $aux = explode(",",$pizza);
            if($aux[1] == $sabor && $aux[2] == $tipo){
                $flag = true;
            }
        }
        return $flag;
    }

    static function nuevoId($lista){
        
        $id = -1;
        if($lista == 0){
            $id = 1;
        }else{
            foreach($lista as $pizza){
                $arrayAtributos = explode(",",$pizza);
               
                if($id < $arrayAtributos[0]){
                    $id =$arrayAtributos[0];
                }
            }
        }
        return $id+1;
    }

    static function busquedaPizza($lista,$tipo,$sabor){
        $ocurrencias = 0;
        $ocurrenciasSabor = 0;
        $ocurrenciasTipo = 0;
        foreach($lista as $pizza){
            $aux = explode(",",$pizza);
            if(strcasecmp($aux[1],$sabor)==0){
                $ocurrenciasSabor++;
                if(strcasecmp($aux[2],$tipo) == 0 ){
                    $ocurrencias = $aux[4];
                }
                else{
                    return "No hay ".$tipo;
                }
            }
            else{
                return "No hay sabor".$sabor;
            }
        }
        return $ocurrencias;
    }

    static function obtenerRegistro($tipo,$sabor,$array){
        
        foreach($array as $objeto){
            $aux=explode(",",$objeto);
            if($sabor == $aux[1] && $tipo == $aux[2]){
                  
                return $aux;
            }
        }
        return null;
    }

    static function modificar($array,$cantidad,$id){
        echo($array);
        foreach($array as $objeto){
            $objetoArray = explode(",",$objeto);
            if($objeto[0] == $id){
                $objeto[4]=$cantidad;
            }
        }
        return $array;
    }
}
?>