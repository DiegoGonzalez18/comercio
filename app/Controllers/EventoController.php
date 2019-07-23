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


use App\Models\{Evento};

class EventoController{
 
    public function registrar($titulo,$url,$fecha,$contenido){
           echo "titulo :".$titulo."<br>"."url :".$url."<br>"."fecha :".$fecha."<br>"."contenido :".$contenido."<br>";
    }

}
$a = new EventoController();
$a->registrar($_POST['titulo'],$_FILES['archivo']['name'],$_POST['date-input'],$_POST['a']);