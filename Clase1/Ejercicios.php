<?php
echo"Ejercicio1 \n";
$nombre = Juliet;
$apellido = Gutierrez;

echo $apellido.",".$nombre."\n";

echo"Ejercicio2\n";

$x = -3;
$y = 15;
$z = $x+$y;

echo $z."\n";

echo"Ejercicio3\n\n";

echo $x."\n";
echo $y."\n";
echo $z."\n";

echo"Ejercicio4\n\n";
$contador = 0;
for($i = 0; $resultado < 1000; $i++){
    $resultado += $i;
    echo $resultado."\n";
    $contador++;
}
echo "Cantidad de numeros: ".$contador."\n\n";

echo"Ejercicio5\n\n";

$a =6; $b = 9; $c = 6;

if(($a > $b && $a <$c) || $a < $b && $a > $c){
    echo "El valor del medio es ".$a;
}
elseif(($b < $a && $b > $c) ||($b > $a && $b < $c)){
    echo "El valor del medio es ".$b;
}
else if(($c > $b && $c <$a) || ($c < $b && $c > $a)){
    echo "El valor del medio es ". $c;
}
else{
    echo "No hay valor del medio\n\n";
}

echo"Ejercicio6\n\n";
$op1 = 6; $op2 = 0;
$operador = '/';

switch($operador){
    case '+':
    $resultado = $op1 + $op2;
    echo "\n\n".$resultado;
    break;
    case '-':
    $resultado = $op1 - $op2;
    echo "\n\n".$resultado;
    break;
    case '*':
    $resultado = $op1 * $op2;
    echo "\n\n".$resultado;
    break;
    case '/':
    if($op2 == 0){
        echo "ERROR";
    }
    else{
        $resultado = $op1 / $op2;
        echo "\n\n".$resultado;
    }
    
    break;
}

echo"Ejercicio7\n\n";
//$fecha = function date();

echo"Ejercicio9\n\n";

$array[4] = function rand(0,10);
$array[2] = function rand(0,10);
$array[3] = function rand(0,10);
$array[0] = function rand(0,10);
$array[1] = function rand(0,10);

$suma = 0;
for($i = 0; $i < 5; $i++){
    echo "\n\n".$array[$i];
    $suma += $array[$i];
}

$promedio = $suma /5;

echo "\n\n".$promedio;
?>