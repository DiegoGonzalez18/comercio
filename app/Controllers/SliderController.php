<?php
namespace App\Controllers;
require '../../vendor/autoload.php';

require_once 'db.php';
use App\Models\{Slider};

class SliderController{

  public function registerSlider($titulo,$archivo,$nombre_archivo){
      
  if(!empty($titulo)&&!empty($nombre_archivo)){
    if(!file_exists('./views/assets/uploads')){
        mkdir('./views/assets/uploads',0777,true);
       
      }else
        if(move_uploaded_file($archivo,'./views/assets/uploads/'.$nombre_archivo)){
            
                $slider = new Slider;
                $slider->titulo = $titulo;
                $slider->url = 'assets/uploads/'.$nombre_archivo;
                $slider->save();
            echo 1;
        }else{
          echo 0;
        }
      
  }

  }
}
$a=new SliderController();
$a->registerSlider($_POST['titulo'],$_FILES['archivo']['tmp_name'],$_FILES['archivo']['name']);