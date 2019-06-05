<?php
require 'vendor/autoload.php';

$config =['settings' => [
    'addContentLenghtHeader' => false,
    'displayErrorDetails' => true
]];

/* $app = new \Slim\App($config);

$app->get('/',function($request,$response){
    return $response->write("Hola");
}); */

$app->group('/clase',function(){
    $this->get('/',claseApi:: class.':traerTodos');
    $this->get('/{id}',claseApi:: class.':traerUno');
    $this->post('/',claseApi:: class.':CargarUno');
    $this->delete('/',claseApi:: class.':BorrarUno');
    $this->put('/',claseApi:: class.':ModificarUno');
});
$app->run();
?>
Heredar de la clase de acceso de datos e implementar por la interface.