<?php
include_once('archivo.php');
include_once('usuario.php');

$archivoUsuario = new Archivo('usuarios.txt');

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
        if($auxUsuario->ocurrenciasClave($LecturaArchivo) == true){
            echo('true');
        }
        else{
            echo("Usuario o contraseña incorrectos");
        }
        break;
    }
}
?>