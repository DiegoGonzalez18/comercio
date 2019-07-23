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
    <form class="form-horizontal" id="registrarSlider"  method="post" action="" 
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
        <textarea cols="80" id="editor1" name="editor1"  rows="10" data-sample-short>&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href=&quot;https://ckeditor.com/&quot;&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;</textarea>
 
       
     <br>
        
        <button class="btn btn-sm btn-primary" id="enviarEvento" type="submit">
<i class="fa fa-dot-circle-o" ></i> Submit</button>
       
    </form>
</div>
</main> 
<div class="r"></div>
<script>
    CKEDITOR.addCss('.cke_editable { font-size: 15px; padding: 2em; }');

    CKEDITOR.replace('editor1', {
      toolbar: [{
          name: 'document',
          items: ['Print']
        },
        {
          name: 'clipboard',
          items: ['Undo', 'Redo']
        },
        {
          name: 'styles',
          items: ['Format', 'Font', 'FontSize']
        },
        {
          name: 'colors',
          items: ['TextColor', 'BGColor']
        },
        {
          name: 'align',
          items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
        },
        '/',
        {
          name: 'basicstyles',
          items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting']
        },
        {
          name: 'links',
          items: ['Link', 'Unlink']
        },
        {
          name: 'paragraph',
          items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
          name: 'insert',
          items: ['Image', 'Table']
        },
        {
          name: 'tools',
          items: ['Maximize']
        },
        {
          name: 'editing',
          items: ['Scayt']
        }
      ],

      extraAllowedContent: 'h3{clear};h2{line-height};h2 h3{margin-left,margin-top}',

      // Adding drag and drop image upload.
      extraPlugins: 'print,format,font,colorbutton,justify,uploadimage',
      uploadUrl: './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

      // Configure your file manager integration. This example uses CKFinder 3 for PHP.
      filebrowserBrowseUrl: './ckfinder/ckfinder.html',
      filebrowserImageBrowseUrl: './ckfinder/ckfinder.html?type=Images',
      filebrowserUploadUrl: './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
      filebrowserImageUploadUrl: './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

      height: 560,

      removeDialogTabs: 'image:advanced;link:advanced'
    });
  </script>


























<script>
 $("#enviarEvento").click(function(){
    event.preventDefault();
    var contenido = CKEDITOR.instances['editor1'].getData();
    console.log($('#registrarSlider').serialize());
    
    var formData = new FormData(document.getElementById("registrarSlider"));
    formData.append('a',contenido);
   if(($('#titulo').val().length > 0) &&  (document.getElementById("archivo").files.length > 0)){
     
$.ajax({
    type:  'POST',
                //datos que se envian a traves de ajax
                url:   'app/Controllers/EventoController.php',
                data: formData,
                contentType: false,
                processData: false,
               //archivo que recibe la peticion
                 //método de envio
            
               
                success:  function (response) {
               $('.r').append(response);
                   
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

