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
    <li class="breadcrumb-item"><a href="#">Evento</a></li>
    <li class="breadcrumb-item active">Registrar Evento</li>
</ol>
<div class="container-fluid">
    <!-- Ejemplo de tabla Listado -->
    <div class="card">  
     <div class="card-header">Registrar 
         <strong>Evento</strong>
     </div>
 <div class="card-body">
    <form class="form-horizontal" id="r"  method="post" action="" 
    enctype="multipart/form-data">
        <div class="form-group row">
                     <label class="col-sm-5 col-form-label" for="input-small">Titulo del Evento</label>
                     <div class="col-sm-6">
                     <input class="form-control form-control-sm" id="titulo" type="text" name="titulo" placeholder="Titulo del Evento">
                     </div>
                    
        </div>
        <div class="form-group row">
                        <label class="col-md-5 col-form-label" for="date-input">Fecha del Evento</label>
                        <div class="col-md-6">
                          <input class="form-control" id="date-input" type="date" name="date-input" placeholder="date">
                          <span class="help-block">Por favor ingresar fecha valida</span>
                        </div>
                      </div>
        <div class="form-group row">
                     <label class="col-sm-5 col-form-label" for="input-small">Imagen</label>
                     <div class="col-sm-6">
                     <input type="file" name="archivo" id="archivo">

        </div></div>
        <div id="toolbar-container"></div>

<!-- This container will become the editable. --><br>
<div id="editor" name="diego">
    <p>This is the initial editor content.</p>
</div>
       
     <br>
        
        <button class="btn btn-sm btn-primary" id="enviarSliderx" type="submit">
<i class="fa fa-dot-circle-o" ></i> Submit</button>
       
    </form>
</div>
</main> <?php if(isset($_POST['diego'])){
    echo $_POST['diego'];
}

?>
<script>
    DecoupledEditor
    
        .create( document.querySelector( '#editor' ) ,{
            
            filebrowserBrowseUrl: './ckfinder/ckfinder.html',
     filebrowserImageBrowseUrl: './ckfinder/ckfinder.html?type=Images',
     filebrowserFlashBrowseUrl:'./ckfinder/ckfinder.html?type=Flash',
     filebrowserUploadUrl: './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
     filebrowserImageUploadUrl: './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
     filebrowserFlashUploadUrl: './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

            ckfinder: {
			uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
		},
		toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
	} )
        
        .then( editor => {
            const toolbarContainer = document.querySelector( '#toolbar-container' );

            toolbarContainer.appendChild( editor.ui.view.toolbar.element );
        
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
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
            
               
                success:  function (response) {
                 
                   if(response==1){
                    alertify.alert('Comercio Internacional', 'Slider Registrado', function(){ alertify.success('Ahora lo puedes Asignar'); });

                   }else if(response ==-1){
                    alertify.alert('Comercio Internacional', 'Error', function(){ alertify.error('La imagen ya esta en la base de datos, para subirla puedes cambiarle el nombre'); });

                   }else{
                    alertify.alert('Comercio Internacional', 'Error', function(){ alertify.error('Error con el servidor. Contacte con el administrador'); });

                   }
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

