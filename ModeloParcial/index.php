<?php
include_once('./proveedor.php');
include_once('./archivo.php');

$archivo = new Archivo('./proveedores.txt');

if(!empty($_POST['caso'])){
    $caso = $_POST['caso'];
    
    switch($caso){
        case "cargarProveedor":
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $foto = $_FILES['foto'];

        $proveedor = new Proveedor($id,$nombre,$email,$foto);
        $archivo->cargar($proveedor);
        break;
    }
}
else(!empty($_GET['caso'])){
    $caso = $_GET['caso'];

    switch($caso)
    {
        case 'consultarProveedor':
        $nombre = $_GET['nombre'];
        $retorno =$archivo->archivoArray();
        $retorno2=$proveedor->consultarProveedor($nombre,$retorno);
        echo $retorno2;
        break;

        case 'proveedores':
        $arrayProveedores = $archivo->archivoArray;
        break;
    }
}
?>
