<?php
include_once('pizza.php');
include_once('archivo.php');
include_once('venta.php');

$archivoPizza = new Archivo('Pizza.txt');
$archivoVenta = new Archivo('Venta.txt');

if(isset($_POST['caso']) && !empty($_POST['caso'])){
    $caso = $_POST['caso'];

    switch($caso){
        case 'PizzaCarga':
        $precio = $_POST['precio'];
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['cantidad'];
        $sabor = $_POST['sabor'];
        $imagen = $_FILES['imagen'];

        $LecturaArchivo = $archivoPizza->readFile();
        $id = Pizza::nuevoId($LecturaArchivo);

        $pizza = new Pizza($precio,$tipo,$cantidad,$sabor,$id,$imagen);
        
        if($LecturaArchivo == 0 || $pizza->ocurrenciasTipoSabor($LecturaArchivo,$tipo,$sabor) == false){
            $archivoPizza->addObject($pizza);
        }
        else{
            echo("La pizza ya está ingresada");
        }
        break;

        case 'AltaVenta':
        $email = $_POST['email'];
        $sabor = $_POST['sabor'];
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['cantidad'];

        $LecturaArchivo = $archivoPizza->readFile();
        $FileVenta = $archivoVenta->readFile();
        $id = Venta::nuevoId($FileVenta);
        $cantidadExistente = Pizza::busquedaPizza($LecturaArchivo,$tipo,$sabor);

        if($cantidadExistente != 0 && $cantidad<=$cantidadExistente){
            
            $pizzaAModificar =Pizza::obtenerRegistro($tipo,$sabor,$LecturaArchivo);
            $atributosPizza = explode(",",$pizzaAModificar);
            $cantidadRestante = $cantidadExistente - $cantidad;
            $precioVenta = $cantidad*$atributosPizza[3];
            $venta = new Venta($id,$email,$sabor,$tipo,$cantidad,$precioVenta);
            $archivoVenta->addObject($venta);
            $nuevoArray = Pizza::modificar($LecturaArchivo,$pizzaAModificar,$atributosPizza,$cantidadRestante);
            $archivoPizza->writeFile($nuevoArray);
        }
        break;
    }
}
else if(isset($_GET['caso']) && !empty($_GET['caso'])){
    $caso = $_GET['caso'];
    switch($caso){
        case 'PizzaConsultar':
        $sabor = $_GET['sabor'];
        $tipo = $_GET['tipo'];

        $LecturaArchivo = $archivoPizza->readFile();
        $Retorno = Pizza::busquedaPizza($LecturaArchivo,$tipo,$sabor);
        if($Retorno != 0){
            echo("Si hay");
        }
        break;

        case 'ListadoDeVentas2':
        $LecturaArchivo=$archivoVenta->readFile();
        Venta::listarVentas($LecturaArchivo);
        break;

        case 'ListadoDeVentas':
        $sabor = $_GET['sabor'];
        $tipo = $_GET['tipo'];

        $LecturaArchivo=$archivoVenta->readFile();
        Venta::listarVentasTipoSabor($LecturaArchivo,$tipo,$sabor);
        break;
    }
}