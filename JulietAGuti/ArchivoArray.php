<?php
$arrayNombres = array("Maria","Juana","Pepe");
$file = fopen("ElArchivoArray.txt","w");

foreach($arrayNombres as $nombre)
{
    fwrite($file,$nombre."<br/>");
}

fclose($file);
?>