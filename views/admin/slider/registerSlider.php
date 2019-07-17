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
    <li class="breadcrumb-item active">Registrar Slider</li>
</ol>
<div class="container-fluid">
    <!-- Ejemplo de tabla Listado -->
    <div class="card">  
     <div class="card-header">Input
         <strong>Sizes</strong>
     </div>
 <div class="card-body">
    <form class="form-horizontal" id="registrarSlider"  method="post" action="/comercio/slider/registrarSlider/" 
    enctype="multipart/form-data">
        <div class="form-group row">
                     <label class="col-sm-5 col-form-label" for="input-small">Titulo del Slider</label>
                     <div class="col-sm-6">
                     <input class="form-control form-control-sm" id="titulo" type="text" name="titulo" placeholder="Titulo del Slider">
                     </div>
        </div>
        <div class="form-group row">
                     <label class="col-sm-5 col-form-label" for="input-small">Imagen</label>
                     <div class="col-sm-6">
                     <input type="file" name="archivo" id="archivo">

        </div>
        
        <button class="btn btn-sm btn-primary" id="enviarSlider" type="submit">
<i class="fa fa-dot-circle-o" ></i> Submit</button>
       
    </form>
</div>
</main>
<script>
 $("#enviarSlider").click(function(){
    event.preventDefault();
    
    var formData = new FormData(document.getElementById("registrarSlider"));
   if(($('#titulo').val().length > 0) &&  (document.getElementById("archivo").files.length > 0)){
 
$.ajax({
    type:  'POST',
                //datos que se envian a traves de ajax
                url:   'app/Controllers/SliderController.php',
                data: formData,
                contentType: false,
                processData: false,
               //archivo que recibe la peticion
                 //método de envio
            
               
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    alertify.alert('Comercio Internacional', 'Slider Registrado', function(){ alertify.success('Ahora lo puedes Asignar'); });

                }
        });

    }else{
        alertify.alert('Comercio Internacional', 'Algún campo esta vacio', function(){ alertify.error('Algún campo esta vacio'); });
 
    }

  });

</script>
        <!-- /Fin del contenido principal -->
    </div>
<?php
include('./views/admin/shared/footer.php');
}

