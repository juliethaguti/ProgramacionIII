<?php
class Usuario{
    private $nombre;
    private $clave;

    function __construct($nombre,$clave){
        $this->nombre = $nombre;
        $this->clave = $clave;
    }

    function __toString(){
        return $this->nombre.",".$this->clave.PHP_EOL;
    }

    function ToJson(){
        return json_encode(explode(",",$this),JSON_FORCE_OBJECT);
    }

    function decodeJson(){
        $retorno = json_decode($this,true);
        return $retorno;
    }

    function ocurrenciasNombre($list,$nombre){
        $flag = false;
        foreach($list as $user){
            $aux = explode(",",$user);
            if($aux[0] == $nombre){
                $flag = true;
            }
        }
        return $flag;
    }

    function ocurrenciasUsuario($list){
        $flag = false;
        foreach($list as $user){
            $aux = explode(",",$user);
            if($aux[0] == $this->nombre && $aux[1] == $this->clave){
                $flag = true;
            }
        }
        return $flag;
    }

    static function busquedaNombre($lista,$nombre){
        $ocurrencias = 0;
        foreach($lista as $user){
            $aux = explode(",",$user);
            if(strcasecmp($aux[0],$nombre) == 0){
                $ocurrencias++;
            }
        }
        return $ocurrencias;
    }
}
?>