<?php

class Persona{

    public $nombre;
    function __construct($nombre){
        $this->nombre = $nombre;
    }

    function Saludar(){
        echo "Hola ".$this->nombre; 
    }
}
?>