<?php
class Archivo{
    private $path;

    function __construct($path){
        $this->path = $path;
    }

    function addObject($object){
        
        $file = fopen($this->path,"a");
        fwrite($file,$object);
        fclose($file);
    }

    function readFile(){
        
        if(file_exists($this->path)){
            
            $i = 0;
            $array = array();
            $archivo = fopen($this->path,"r");
            while(!feof($archivo)){
                $array[$i] = fgets($archivo);
                $i++;
            }
            fclose($archivo);
            return $array;
        }
        else{
            return 0;
        }
    }

    function writeFile($nuevoContenido){
        
        $file = fopen($this->path,"w");
        foreach($nuevoContenido as $objeto){
            fwrite($file,$objeto);
        }
        fclose($file);
    }

    function backUp($registro,$destino){
        
        $array = explode(",",$registro);
        rename(trim($array[4]),$destino);
    }
}
?>