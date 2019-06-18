<?php
use \Firebase\JWT\JWT;

if($email_exist && password_verify($data->password, $user->password)){
    $token = array(
        "data" => array(
            "nombre" => $usuario->nombre,
            "clave" => $usuario->clave,
            "sexo" => $usuario->sexo
            )
        );
        //set response code
        http_response_code(200);
        //genera jwt
        $jwt = JWT::encode($token,$key);
        echo json_encode(
            array(
                "message" => "Login exitoso.",
                "jwt" => $jwt
                )
            );
}
?>