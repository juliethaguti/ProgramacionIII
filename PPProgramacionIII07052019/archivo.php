<?php

class Archivo{
    private $path;

    function __construct($path){
        $this->path = $path;
    }

    function addObject($object){
        
        $file = fopen($this->path,"a");
        fwrite($file,"$object;");
        fclose($file);
    }

    function readFile(){
        if(file_exists($this->path)){
            $array = array();
        $lectura = "";
        $archivo = fopen($this->path,"r");
        while(!feof($archivo)){
            $lectura = fgets($archivo);
        }
        fclose($archivo);
        $array = explode(";",$lectura);
        return $array;
        }
        else{
            return 0;
        }
    }
}
?>