<?php

class Proveedor{
    $id;
    $nombre;
    $email;
    $foto

    function __construct($id,$nombre,$email,$foto){
        $this->id =$id;
        $this->nombre=$nombre;
        $this->email=$email;

        $ext = array_reverse(explode(".",$foto["name"]));
        $this->foto = $this->nombre."_"."Foto.".$ext[0];
        move_uploaded_file($foto["tmp_name"],"./ImagenProveedores/".$this->foto);
    }

    function consultarProveedor($nombre,$array){
        $array = archivoArray();
        $count = 0;

        foreach($array as $objeto){
            foreach($objeto as $item){
                if($item == nombre)
                {
                    $count++;
                }
            }
        }
        if($count == 0)
        {
            return 'No existe proveedor'.$atributo;
        }
        else{
            return $count;
        }

    }

    function listarProveedores(){
        $array = archivoArray();

    }
}
?>