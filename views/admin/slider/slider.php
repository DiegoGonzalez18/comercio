<?php
session_start();
if(!isset($_SESSION['email'])){
    echo '<script>  window.location.href = "?r=login";</script>';
}else{

include('./views/admin/shared/header.php');
include('./views/admin/shared/vertical.php');
?>
<main class="main">
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="#">Slider</a></li>
    <li class="breadcrumb-item active">Ver Slider</li>
</ol>
<div class="container-fluid">
    <!-- Ejemplo de tabla Listado -->
    <div class="card">  
     <div class="card-header">Ver
         <strong>Slider</strong>
     </div>
 <div class="card-body">
 <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Visibilidad</th>
                <th>Fecha de creación</th>
                <th>Ultima Actualización</th>
                <th>Eliminar</th>
                
            </tr>
        </thead>
     
           
            <?php
           require_once ('./app/Controllers/SliderController.php');
            
            
            $a=new SliderController();
       $sliders=  $a->listarSlider();
       
            ?>
            
            
        </tbody>
        <tfoot>
            <tr>
            <th>Titulo</th>
                <th>Imagen</th>
                <th>Visibilidad</th>
                <th>Fecha de creación</th>
                <th>Ultima Actualización</th>
                <th>Eliminar</th>
            </tr>
        </tfoot>
    </table>
    
</div>

            
</main>

        <!-- /Fin del contenido principal -->
    </div>
    <script>
    $('.eliminar').click(function(){

var formData = new FormData();

formData.append('idEliminar',$(this).attr("id"));

$.ajax({
                data:  formData, //datos que se envian a traves de ajax
                url:   'app/Controllers/SliderController.php', //archivo que recibe la peticion
                type:  'post',
                contentType: false,
                processData: false,
                 //método de envio
                
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                
                     if(response>0){
                             aca='#'+response;
                     
                       $(aca).remove();                      
                       alertify.alert('Comercio Internacional', 'Slider Eliminado', function(){ alertify.success('Eliminado'); });
  

                      } 
                }
        });
    });
    </script>
    
<?php
include('./views/admin/shared/footer.php');
}

