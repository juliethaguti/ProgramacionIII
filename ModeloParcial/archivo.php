<?php
class archivo{
    private $path;

    function __construct($path){
        $this->path = $path;
    }

    function cargar($claseString){
        $file = fopen($this->path,"a");
        fwrite($file,$claseString);
        fclose($file);
    }

    function leer(){
        $array = array();
        
        $file=fopen($this->path,'r');
        $str=file($this->path,FILE_IGNORE_NEW_LINES);
        
        for($i = 0; $i < count($str);$i++){
            $str[$i]=$array = explode(",",$str[$i]);
        }
        
        fclose($file);
        return $str; 
    }

    function cuentaOcurrencias($atributo){
        $arrayObjetos = $this->leer();
        $count=0;
        
        for($i = 0; $i < count($arrayObjetos);$i++){
            $arrayObjeto = explode(",",$arrayObjetos[$i]);    
            for($j = 0; $j < count($arrayObjeto);$j++){
                
                if($arrayObjeto[$j] == $atributo)
                {
                    $count++;
                }
            }
        }
        return $count;
    }

    function listar(){
        $array = $this->leer();

        for($i=0;$i<count($array);$i++){
            echo($array[$i]);
        }
    }

    function backUp($carpeta,$registro,$destino){

        rename("$carpeta/$registro[3]",$destino);
    }

    function escribir($array){
        $file = fopen($this->path,"w");
        foreach($array as $objeto){
            if(is_array($objeto)){
                $linea=implode(",",$objeto);
            }
            else
            {
                $linea = trim($objeto);
            }
            fwrite($file,$linea.PHP_EOL);
        }       
        
        fclose($file);
    }
}
?>