<?php

include_once('archivo.php');

class Proveedor{
    private $id;
    private $nombre;
    private $email;
    private $foto;

    function __construct($id,$nombre,$email,$foto){
        $this->id =$id;
        $this->nombre=$nombre;
        $this->email=$email;
        $this->foto = $foto;
        
        $ext = array_reverse(explode(".",$foto["name"]));
        $this->foto = $this->nombre."_"."Foto.".$ext[0];
        move_uploaded_file($foto["tmp_name"],"./ImagenProveedores/".$this->foto);
    }

    public function __toString(){
        return $this->id.",".$this->nombre.",".$this->email.",".$this->foto.PHP_EOL;
    }

    static function obtenerRegistro($id,$array){
        
        foreach($array as $objeto){
            
            if($id == $objeto[0]){
                  
                return $objeto;
            }
        }
        return null;
    }

    function modificar($array,$nuevaEntidad,$registro){
        $out = "";
        for($i = 0;$i<count($array);$i++){
            if($array[$i] == $registro){
                $array[$i] = $nuevaEntidad->__toString();
                break;
            }
        }
        return $array;
    }
    
    static function buscarNombrePorId($array,$id){
        $proveedor = self::obtenerRegistro($id,$array);
        return $proveedor[1];
    }
}
?>
