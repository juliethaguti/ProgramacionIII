<?php
class archivo{
    private $path;

    function __construct($path){
        $this->$path = $path;
    }

    function cargar($clase){
        $file = fopen($this->$path,'a');
        fwrite($file,$clase);
        fclose($file);
    }

    function archivoArray(){
        $array = array();
        
        $file=fopen($this->$path,'r');
        while(!feof($file)){
            $array[]=fgets($file);
        }
        fclose($file);
        return $array;
    }
}
?>