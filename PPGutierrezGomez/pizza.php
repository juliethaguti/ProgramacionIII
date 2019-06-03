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
        $this->imagen = $this->sabor."_".$this->tipo.".".$ext[0];
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
            $id ++;
        }
        return $id;
    }

    static function busquedaPizza($lista,$tipo,$sabor){
        $ocurrenciasSabor = 0;
        $ocurrenciasTipo = 0;
        foreach($lista as $pizza){
            $aux = explode(",",$pizza);
            if((strcasecmp($sabor,$aux[1])==0) && (strcasecmp($tipo,$aux[2]) == 0)){
                return $aux[4];
            }
            else if(strcasecmp($sabor,$aux[1])==0){
                $ocurrenciasSabor++;
            }
            else if(strcasecmp($tipo,$aux[2]) == 0){
                $ocurrenciasTipo++;
            }
        }
        if($ocurrenciasSabor == 0 && $ocurrenciasTipo == 0){
            echo("No hay ni sabor ".$sabor."ni tipo ".$tipo.PHP_EOL);
        }
        else if($ocurrenciasSabor == 0 && $ocurrenciasTipo != 0){
            echo("No hay sabor ".$sabor.PHP_EOL);
        }
        else{
            echo("No hay tipo ".$tipo.PHP_EOL);
        }
    }

    static function obtenerRegistro($tipo,$sabor,$array){
        
        foreach($array as $objeto){
            $aux=explode(",",$objeto);
            if($sabor == $aux[1] && $tipo == $aux[2]){
                  
                return $objeto;
            }
        }
        return null;
    }

    static function modificar($array,$objetoAModificar,$atributosPizza,$cantidadRestante){
        $nuevaPizza = $atributosPizza[0].",".$atributosPizza[1].",".$atributosPizza[2].",".$atributosPizza[3].",".$cantidadRestante.",".$atributosPizza[5];
        $key = array_search($objetoAModificar,$array);
        $array[$key]=$nuevaPizza;
        return $array;
    }
}
?>