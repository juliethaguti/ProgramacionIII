<?php
use Firebase\JWT\JWT;

class Auth{
    private static $secret_key = 'Sdw1s9x8@';
    private static $encrypt = ['HS256'];
    private static $aud = null;

    public static function SignIn($data){
        $time = time();
        $token = array(
            'exp' => $time + (60*60),
            'aud' => self::Aud(),
            'data' => $data
        );

        return JWT::encode($token, self::$secret_key);
    }

    public static function Check($token){
        if(empty($token)){
            throw new Exception("Invalid");
        }
        $decode =JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        )->data;
    }

    private static function Aud(){
        $aud = '';

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
}
?>

middleware el medio de api y peticiones, se pueden tener tantos middleware como yo quiera...
y las peticiones pasan por mid1 mid2 y mid3 por ejemplo. El primero hace un logueo, el segundo autentica auth, el tercero se fija
si es nivel administrador, como por decir algo