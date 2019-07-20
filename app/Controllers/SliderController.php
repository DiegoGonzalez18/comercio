<?php
 use Illuminate\Database\Capsule\Manager as Capsule;
 use Illuminate\Pagination\Paginator; 
 use Illuminate\Pagination\LengthAwarePaginator;
try {

  if (! @include_once( '../../vendor/autoload.php' )){} // @ - to suppress warnings, 
  // you can also use error_reporting function for the same purpose which may be a better option
   
  // or 
  if (!file_exists('../../vendor/autoload.php' )){}
   // throw new Exception ('functions.php does not exist');
  else{
    require_once('../../vendor/autoload.php' ); 
  }}
  catch(Exception $e) {    
    require_once ('./vendor/autoload.php');
  }


require_once 'db.php';


use App\Models\{Slider};

class SliderController{

  public function registerSlider($titulo,$archivo,$nombre_archivo){
      $slider=Slider::all()->count();

                     
  if(!empty($titulo)&&!empty($nombre_archivo)){
    if(!file_exists('uploads')){
        mkdir('uploads',0777,true);
    
      }
        if(move_uploaded_file($archivo,'uploads/'.$nombre_archivo)){
            
                $slider = new Slider;
                $slider->titulo = $titulo;
                $slider->url = 'uploads/'.$nombre_archivo;
                $as=Slider::where('url','=',$slider->url)->count();
                if($as>0){
                  echo -1;
                }else{
                $slider->save();

            echo 1;
          }
        }else{
          echo 0;
        }
      
  }

  }
  public function listarSlider(){
   $a= Slider::get();
   $cad="";
foreach($a as $item){
  $a=0;
   if($item["visible"]==1){
$a="<center><span class='badge badge-success'>Visible</span></center>";
   }else{
    $a="<center><span class='badge badge-danger'>No Visible</span></center>";
   }
  $cad .=' <tr id="'.$item["id"].'"><td>'.$item["titulo"].'</td>'.
  ' <td><img width="100px"src="./app/Controllers/'.$item["url"].'"></td>'.
   '<td>'.$a.'</td>'.
   '<td>'.$item["created_at"].'</td>'.
   '<td>'.$item["updated_at"].'</td><td class=""><button type="button" class="btn btn-danger eliminar" id="'.$item["id"].'">Eliminar</button></td></tr>';
  
   
}
echo $cad;
  }
 


  public function eliminar($id){
   
    $peli=Slider::where('id', '=', $id)->first();
 
// Lo eliminamos de la base de datos
  if($peli->delete() ){
    unlink($peli->url);
    echo $id;
  }else{
    echo 0;
  }

  }
}
if(isset($_POST['titulo'])&&isset($_FILES['archivo']['tmp_name'])){
$a=new SliderController();
$a->registerSlider($_POST['titulo'],$_FILES['archivo']['tmp_name'],$_FILES['archivo']['name']);
}else if(isset($_POST['listar'])){
  $a=new SliderController();
        $a->listarSlider();
}else if(isset($_POST['idEliminar'])){
        $a=new SliderController();
        
        $a->eliminar($_POST['idEliminar']);
}
