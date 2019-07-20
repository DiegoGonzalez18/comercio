<?php
namespace App\Controllers;
class ViewController
{
    private static $view_patch = './views/';
    public function load_view($view)
    {
        if($view=='login'||$view=='home' ){
            require_once(self::$view_patch .'admin/'. $view . '.php');
        }else if($view=='registerSlider'||$view=='slider'||$view=='asignarSlider'){
            require_once(self::$view_patch .'admin/slider/'. $view . '.php');

        } else{
            require_once(self::$view_patch . $view . '.php');
        }
    }
}
 