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
                <th>Estado</th>
                <th>Fecha de creación</th>
                <th>Ultima Actualización</th>
                <th>Eliminar</th>
                <th>Editar</th>
                
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
                <th>Estado</th>
                <th>Fecha de creación</th>
                <th>Ultima Actualización</th>
                <th>Eliminar</th>
                <th>Editar</th>
            </tr>
        </tfoot>
    </table>
    
</div>

            
</main>
<!--Inicio del modal agregar/actualizar-->
<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Slider</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" id="editar" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Titulo</label>
                                    <div class="col-md-9">
                                        <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Titulo del Slider">
                                        <span class="help-block">(*) Ingrese el Titulo del Slider</span>
                                    </div>
                                </div>
                                <input type="text" id="idEd" hidden name="idEd" class="form-control" placeholder="Titulo del Slider">
                                <input type="text" id="url" hidden name="url" class="form-control" placeholder="Titulo del Slider">
                                    
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Imagen</label>
                                   
                                    <div class="col-md-9">
                                    <input type="file"  name="archivi" id="archivi"><br>
                                    <span class="help-block">(*) Si no selecciona ninguna imagen , se deja la que esta</span>
                                 </div>
                                </div>
                                <div id="img"></div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary editarb">Guardar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
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
    <script>
    $('.editar').click(function(){
console.log($(this).attr("id"));
var formData = new FormData();
formData.append('idEditar',$(this).attr("id"));
$.ajax({
                data:  formData, //datos que se envian a traves de ajax
                url:   'app/Controllers/SliderController.php', //archivo que recibe la peticion
                type:  'post',
                contentType: false,
                processData: false,
                 //método de envio
                
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    var obj = JSON.parse(response);
                    console.log(obj['titulo']); 
                    $("#titulo").val((obj['titulo']));
                    $("#idEd").val((obj['id']));
                    $("#url").val((obj['url']));
                    $('#img').append('<center><img height="200px" width="400px"src="./app/Controllers/'+obj['url']+'"></center>');
                }
        });
    });
    </script>
    <script>
    $('.editarb').click(function(){
        if(($('#titulo').val().length > 0) ){
var formData = new FormData(document.getElementById("editar"));
formData.append('idEd',$("#idEd").val());
formData.append('url',$("#url").val())

$.ajax({
                data:  formData, //datos que se envian a traves de ajax
                url:   'app/Controllers/SliderController.php', //archivo que recibe la peticion
                type:  'post',
                contentType: false,
                processData: false,
                 //método de envio
                
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    if(response==1){
                        alertify.confirm('Comercio Internacional', 'Slider Actualizado , puede ir a asignarlo', function(){  window.location.href = "?r=slider" }
                , function(){ alertify.error('Cancel')});
                   }else if(response ==-1){
                    alertify.alert('Comercio Internacional', 'Error', function(){ alertify.error('La imagen ya esta en la base de datos, para subirla puedes cambiarle el nombre'); });

                   }else{
                    alertify.alert('Comercio Internacional', 'Error', function(){ alertify.error('Error con el servidor. Contacte con el administrador'); });

                   }
                 }
        });}
    });
    </script>
    
<?php
include('./views/admin/shared/footer.php');
}

