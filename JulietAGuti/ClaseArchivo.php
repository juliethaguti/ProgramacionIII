<?php
$retorno = fopen("ElArchivo.txt","w");

$indicador = fwrite($retorno,"Esto es lo que vamos a escribir en el archivo, si queremos mas escribimos mas, en caso en querer un arcivo muy grande seguimos escribiendo");

 //echo fread($retorno,sizeof($retorno));
 fclose($retorno);

 $ar = fopen("ElArchivo.txt", "r");

 while(!feof($ar))
 {
     echo fgets($ar), "<br/>";
 }
 //echo fread($retorno2,sizeof($retorno));
 fclose($ar);

 //Array

 $arrayNombres = array("Juana","Roberta","Josefa");

 $file = fopen("ElArchivo.txt","a");

 foreach($arrayNombres as $nombre)
 {
     fputs($file,$nombre."<br/>");
 }

 fclose($file);
?>