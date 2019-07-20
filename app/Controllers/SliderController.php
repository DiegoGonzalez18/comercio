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
    // $slider=Slider::all()->count();

                     
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
   '<td>'.$item["updated_at"].
   '</td><td class=""><button type="button" class="btn btn-danger eliminar" id="'.$item["id"].'">Eliminar</button></td><td>
   <button type="button" data-toggle="modal" data-target="#modalNuevo" class="btn btn-info editar" id="'.$item["id"].'">Editar</button></td></tr>';
  
   
}
echo $cad;
  }
 
public function traerDatos($id){
  $a=Slider::where('id', '=', $id)->first();
echo json_encode($a);
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
  public function editarConImagen($id,$titulo,$archivo,$nombre_archivo){
    
    $slider= Slider::where('id','=',$id)->first();
    $num= Slider::where('id','=',$id)->count();
    ;
    if(!empty($titulo)&&!empty($nombre_archivo)){
      if(!file_exists('uploads')){
          mkdir('uploads',0777,true);
      
        }
          if(move_uploaded_file($archivo,'uploads/'.$nombre_archivo)){
         
            if($num>=1){

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
}
public function editaSinImagen($id,$titulo){
    
    $slider= Slider::where('id','=',$id)->first();
  
    ;
    if(!empty($titulo)){
      $slider->titulo=$titulo;
      $slider->save();
      echo 1;
  }else{
    echo 0;
  }

}

public function listarAsignacion(){
  echo json_encode(Slider::all());
}


public function asignar($arreglo){
  
  if(count($_POST['arreglo'])<6&&count(json_decode($_POST['arreglo']) )>0){
    
$r=Slider::all();
foreach($r as $t){
  $t->visible=0;
  $t->save();
}$r2=Slider::where(function ($query) {
  foreach(json_decode($_POST['arreglo']) as $select) {
     $query->orWhere('id', '=', $select);
  }
})->get();
foreach($r2 as $t){
  $t->visible=1;
  $t->save();
} echo 1;
}else{
  echo 0;
}
  
  /*foreach ($data as $valor) {
    $valor = $valor * 2;
 $slider=Slider::where('id',"=",$valor);
 $slider->visibilidad=True;
 
 $r=Slider::where(function ($query) {
  foreach(json_decode($_POST['arreglo']) as $select) {
     $query->orWhere('id', '=', $select);
  }
})->get();
foreach($r as $t){
  $t->visible=1;
  $t->save();
}
$r=Slider::where(function ($query) {
  foreach(json_decode($_POST['arreglo']) as $select) {
     $query->orWhere('id', '!=', $select);
  }
})->get();
foreach($r as $t){
  $t->visible=0;
  $t->save();
}
*/

}
}


//Llamo los metodos
if(isset($_POST['titulo'])&&isset($_FILES['archivo']['tmp_name'])){
$a=new SliderController();
$a->registerSlider($_POST['titulo'],$_FILES['archivo']['tmp_name'],$_FILES['archivo']['name']);
}else if(isset($_POST['listar'])){
  $a=new SliderController();
        $a->listarSlider();
}else if(isset($_POST['idEliminar'])){
        $a=new SliderController();
        
        $a->eliminar($_POST['idEliminar']);
}else if(isset($_POST['idEditar'])){
  $a=new SliderController();
        
  $a->traerDatos($_POST['idEditar']);
}else 
if(isset($_POST['idEd'])){

if(!empty($_FILES['archivi']['tmp_name'])){
  
$a= new SliderController();
$a->editarConImagen($_POST['idEd'],$_POST['titulo'],$_FILES['archivi']['tmp_name'],$_FILES['archivi']['name']);
}else {
 
$a= new SliderController();
$a->editaSinImagen($_POST['idEd'],$_POST['titulo']);
}
}else
 if(isset($_POST['traer'])){
  $a= new SliderController();
  $a->listarAsignacion();
}else if(isset($_POST['arreglo'])){

  $a= new SliderController();
  $a->asignar($_POST['arreglo']);
}