<?php

namespace App\Controllers;

use App\Models\{Usuario};

require_once 'db.php';
    
class UsuarioController{
    public function login($email,$clave){
       
        $user = Usuario::where("email","=",$email)->where('clave','=',$clave)->first();
       //var_dump( $user);
      
        if($user->email==$email&&$user->clave==$clave){
            session_start();
            $_SESSION['email']=$user->email;
            $_SESSION['user']=$user->user;
            echo 1;
        }else{
            echo 0;
        }
    
    }
}
$usuario= new UsuarioController();
if(isset($_POST['email'])&&isset($_POST['clave'])){
$usuario->login($_POST['email'],$_POST['clave']);
}