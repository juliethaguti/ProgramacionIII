<?php
include_once('archivo.php');
include_once('usuario.php');
include_once('producto.php');

$archivoUsuario = new Archivo('usuarios.txt');
$archivoProductos = new Archivo('productos.txt');

if(isset($_POST['caso']) && !empty($_POST['caso'])){
    $caso = $_POST['caso'];

    switch($caso){
        case 'crearUsuario':
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $usuario = new Usuario($nombre,$clave);
        $LecturaArchivo = $archivoUsuario->readFile();
        
        if($LecturaArchivo == 0 || $usuario->ocurrenciasNombre($LecturaArchivo,$nombre) == false){
            $archivoUsuario->addObject($usuario);
        }
        else{
            echo("El usuario ya está ingresado");
        }
        break;
        case 'login':
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $auxUsuario = new Usuario($nombre,$clave);
        $LecturaArchivo = $archivoUsuario->readFile();
        if($auxUsuario->ocurrenciasUsuario($LecturaArchivo) == true){
            echo('true');
        }
        else{
            echo("Usuario o contraseña incorrectos");
        }
        break;

        case 'cargarProducto':
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $usuario = $_POST['usuario'];
        $imagen = $_FILES['imagen'];
        $id = $_POST['id'];
        $LecturaArchivo = $archivoProductos->readFile();
        //$id = Producto::nuevoId($LecturaArchivo);
        $producto = new Producto($id,$nombre,$precio,$imagen,$usuario);
        $archivoProductos->addObject($producto);
        break;

        case 'modificarProducto':
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $usuario = $_POST['usuario'];
            $imagen = $_FILES['imagen'];
            $id = $_POST['id'];

            $array = $archivoProductos->readFile();
            $registro=Producto::obtenerRegistro($id,$array);
            
            if($registro != null){
                $fecha=date("ymd");
                $nombreBackUp="./backUpFotos/".$id."-"."$fecha".".jpg";
                
                $productoModificado = new Producto($id,$nombre,$precio,$imagen,$usuario);
                $archivoProductos->backUp($registro,$nombreBackUp);
                $nuevoArray = $productoModificado->modificar($array,$productoModificado,$registro);
                $archivoProductos->writeFile($nuevoArray);
            }
            else{
                echo ("El producto no existe");
            }
            break;
    }
}
else if(isset($_GET['caso']) && !empty($_GET['caso'])){
    $caso = $_GET['caso'];

    switch($caso){
        case 'listarUsuario':
        $nombre = $_GET['nombre'];
        $LecturaArchivo = $archivoUsuario->readFile();
        $Retorno = Usuario::busquedaNombre($LecturaArchivo,$nombre);
        if($Retorno != 0){
            echo($Retorno);
        }
        else{
            echo("No existe ".$nombre);
        }
        break;

        case 'listarProductos':
        $producto = $_GET['producto'];
        $usuario = $_GET['usuario'];
        $lista = $archivoProductos->readFile();
        //var_dump($lista);
        if($usuario != ""){
            Producto::listarProductosByUsuario($usuario,$lista);
        }
        else if($producto != ""){
            Producto::listarProductosByProducto($producto,$lista);
        }
        break;
    }
}
?>