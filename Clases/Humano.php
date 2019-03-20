<?php
abstract class Humano
{
    public $nombre;
    public $apellido;

    public function _contruct($name,$lastname){
        $this->$nombre = $name;
        $this->$apellido = $lastname;
    }
}
?>