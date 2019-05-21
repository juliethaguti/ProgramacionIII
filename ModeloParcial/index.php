<?php
include_once('./proveedor.php');
include_once('./archivo.php');
include_once('./pedidos.php');

$archivoProveedores = new archivo("./proveedores.txt");
$archivoPedidos = new archivo("./pedidos.txt");

if(!empty($_POST["caso"])){
    $caso = $_POST["caso"];
    
    switch($caso){
        case "cargarProveedor":
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $foto = $_FILES['foto'];

        $proveedor = new Proveedor($id,$nombre,$email,$foto);
        $archivoProveedores->cargar($proveedor);
        break;

        case "hacerPedido":
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $idProveedor = $_POST['idProveedor'];

        $retorno = $archivoProveedores->cuentaOcurrencias($idProveedor);
        if($retorno != 0){
            $pedido = new pedidos($producto,$cantidad,$idProveedor);
            $archivoPedidos->cargar($pedido);
        }
        else{
            echo('El proveedor no existe');
        }
        break;

        case "modificarProveedor":
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $foto = $_FILES['foto'];
        
            $array = $archivoProveedores->leer();
            $registro=Proveedor::obtenerRegistro($id,$array);
            
            if($registro != null){
                $fecha=date("ymd");
                $nombreBackUp="./backUpFoto/$id.$fecha.png";
                $carpeta="./ImagenProveedores";

                $proveedorModificado = new Proveedor($id,$nombre,$email,$foto);
                $archivoProveedores->backUp($carpeta,$registro,$nombreBackUp);
                $nuevoArray = $proveedorModificado->modificar($array,$proveedorModificado,$registro);
                $archivoProveedores->escribir($nuevoArray);
            }
            else{
                echo ("El proveedor no existe");
            }
            
            break;
    }
}
else if(!empty($_GET["caso"])){

    $caso = $_GET["caso"];

    switch($caso)
    {
        case "consultarProveedor":
        $nombre = $_GET['nombre'];
        $retorno=$archivoProveedores->cuentaOcurrencias($nombre);
        if($retorno == 0){

            echo('No existe proveedor '.$nombre);
        
        }
        else{
            echo ($count);
        }
        break;

       case "proveedores":
        $archivoProveedores->listar();
        break;

        case "listarPedidos":
        $archivoPedidos->listar();
        break;

        case "listarPedidoProveedor":
        $idProveedor=$_GET['idProveedor'];
        $array=$archivoPedidos->leer();
        pedidos::listarPedidoProveedor($idProveedor,$array);
        break;
        
        case "fotosBack":
        $arrayProveedores = $archivoProveedores->leer();
        $arrayBackUpFoto = scandir("./backUpFoto");

        $tabla = "<table>
        <thead>
            <tr>        
                <th>Proveedor</th>
                <th>Fecha de modificación</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>";
        
        for($i = 2; $i <count($arrayBackUpFoto);$i++){
            $nombreFile = explode(".",$arrayBackUpFoto[$i]);
            $nombreProveedor = proveedor::buscarNombrePorId($arrayProveedores,$nombreFile[0]);
            
            $tabla .="<tr>
                <td>$nombreProveedor</td>
                <td>$nombreFile[1]</td>
                <td><img style='width: 220px; height: 590px;' src='./backUpFoto/$arrayBackUpFoto[$i]'></td>
            </tr>";
        }
        $tabla .= "</tbody>
        </table>";

        echo ($tabla);
        break;
    }
}
?>
