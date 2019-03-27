<?php
$nombreArchivo = "Alumnos.csv";
$nombreAlumno = $_POST ['nombre'];
$ApellidoAlumno = $_POST['apellido'];
$LegajoAlumno = $_POST['legajo'];
$numeroAlumno = $_POST['numero'];

$file = fopen($nombreArchivo,"w");

function toCsv($nombreAlumno,$ApellidoAlumno,$LegajoAlumno,$numeroAlumno);
{

}

function toJson()
{
    return json_encode();
}
?>