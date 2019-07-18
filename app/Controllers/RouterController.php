<?php
use App\Controllers\ViewController;
namespace App\Controllers;

class RouterController
{
    public function __construct()
    {
        
        $home = new ViewController();

        $vista = "index";

        if (isset($_GET['r'])) {
            if($_GET['r']=='login'){

                $home->load_view('login');
            }else if($_GET['r']=='home'){
                $home->load_view('home');
            }else if($_GET['r']=='registerSlider'){
                $home->load_view('registerSlider');
            }else if($_GET['r']=='slider'){
                $home->load_view('slider');
            }
          
            }
       
               
            

          
       // $home->load_view($vista);
    }
  
}
