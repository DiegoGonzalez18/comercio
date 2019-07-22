<?php
use App\Controllers\ViewController;
namespace App\Controllers;

class RouterController
{
    public function __construct()
    {
        
        $home = new ViewController();

     

        if (isset($_GET['r'])) {
            if($_GET['r']=='login'){

                $home->load_view('login');
            }else if($_GET['r']=='home'){
                $home->load_view('home');
            }else if($_GET['r']=='registerSlider'){
                $home->load_view('registerSlider');
            }else if($_GET['r']=='slider'){
                $home->load_view('slider');
            }else if($_GET['r']=='asignarSlider'){
                $home->load_view('asignarSlider');
            }
            else if($_GET['r']=='registerEvento'){
                $home->load_view('registerEvento');
            }
          
            }
            else if(!isset($_GET['r'])){
                $home->load_view('index');
            }
       
               
            

          
       // $home->load_view($vista);
    }
  
}
