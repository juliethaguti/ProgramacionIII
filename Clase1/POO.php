<?php
include './Clases/Alumno.php';
require_once './Clases/Persona.php';
//require ó include_once ó require_once
$NuevaPersona = new Persona("Julia");
$NuevoAlumno = new Alumno("José");

$NuevoAlumno->Saludar();
?>