<?php
include_once('archivo.php');

class pedidos{
    private $producto;
    private $cantidad;
    private $idProveedor;

    function __construct($producto,$cantidad,$idProveedor){
        $this->producto = $producto;
        $this->cantidad = $cantidad;
        $this->idProveedor = $idProveedor;
    }

    function __toString(){
        return $this->producto.",".$this->cantidad.",".$this->idProveedor.PHP_EOL;
    }

    static function listarPedidoProveedor($idProveedor,$array){
        $contador = 0;
        
        foreach($array as $objeto)
        {
            if($idProveedor == $objeto[2]){
                echo $objeto[0].",".$objeto[1].",".$objeto[2]."<br>";
                $contador++;
            }
        }
        if($contador == 0){
            echo("El proveedor no tiene pedidos");
        }
    }
}
?>