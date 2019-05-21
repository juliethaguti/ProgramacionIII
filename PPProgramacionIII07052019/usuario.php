<?php
class Usuario{
    private $nombre;
    private $clave;

    function __construct($nombre,$clave){
        $this->nombre = $nombre;
        $this->clave = $clave;
    }

    function __toString(){
        return $this->nombre.",".$this->clave;
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

    function ocurrenciasClave($list){
        $flag = false;
        foreach($list as $user){
            $aux = explode(",",$user);
            if($aux[1] == $this->clave && $this->ocurrenciasNombre($list,$this->nombre) == true){
                $flag = true;
            }
        }
        return $flag;
    }
}
?>