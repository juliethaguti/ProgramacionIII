<?php
class Venta{
    private $id;
    private $email;
    private $sabor;
    private $tipo;
    private $cantidad;
    private $precioVenta;

    function __construct($id,$email,$sabor,$tipo,$cantidad,$precioVenta){
        $this->email = $email;
        $this->sabor = $sabor;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;
        $this->id = $id;
        $this->precioVenta = $precioVenta;
    }

    function __toString(){
        return $this->id.",".$this->email.",".$this->sabor.",".$this->tipo.",".$this->cantidad.",".$this->precioVenta.PHP_EOL;
    }

    function ToJson(){
        return json_encode(explode(",",$this),JSON_FORCE_OBJECT);
    }

    function decodeJson(){
        $retorno = json_decode($this,true);
        return $retorno;
    }

    static function nuevoId($lista){
        
        $id = -1;
        if($lista == 0){
            $id = 1;
        }else{
            foreach($lista as $pizza){
                $arrayAtributos = explode(",",$pizza);
               
                if($id < $arrayAtributos[0]){
                    $id =$arrayAtributos[0];
                }
            }
        }
        return $id+1;
    }
}
?>