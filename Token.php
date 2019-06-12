<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

$time = time();
$key = 'my_secret_key';

$token = array(
    'iat' => $time,
    'exp' => $time + (60*60),
    'data' => [
        'id' => 1,
        'name' => 'Eduardo'
    ]
);

$jwt = JWT::encode($token,$key);
//$data = JWT::decode($jwt, $key,array('HS256'));
$data = JWT::decode($jwt, 'SOY OTRO KEY',array('HS256'));
var_dump($data);
?>