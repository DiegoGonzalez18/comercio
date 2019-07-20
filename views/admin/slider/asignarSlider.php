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
    <li class="breadcrumb-item active">Asignar Slider</li>
</ol>
<div class="container-fluid">
    <!-- Ejemplo de tabla Listado -->
   
     <div class="row">
     <div class="col-sm-12 col-xl-6">
                <div class="card">
                  <div class="card-header">
                    <i class="fa fa-align-justify"></i> Sliders 
                    <small>Desactivados</small>
                  </div>
                  <div class="card-body">
                    <ul class="list-group" id="lista">
                      
                     
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-xl-6">
                <div class="card">

                  <div class="card-header">
                    <i class="fa fa-align-justify"></i>Slider
                    <small>Sliders Activados</small>
                  </div>
                  <div class="card-body">
                    <ul class="list-group" id="lista2">
                      
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <button class="btn btn-danger btn-lg btn-block" type="button" id="guardar">Guardar Configuración</button>
</div>

            
</main>
<!--Inicio del modal agregar/actualizar-->
            <!--Fin del modal-->
        <!-- /Fin del contenido principal -->
    </div>
    <script>
        $('#guardar').click(function(){
            var divs = document.getElementsByClassName("activado"); 
var numDivs = divs.length; 
var arreglo=[];
var c = 0; 
for(var i = 0; i < numDivs; i++){
    at=$(divs[i]).attr("id");
    arreglo.push(at);
  
} 
$.ajax({
          type: "POST",
          url: 'app/Controllers/SliderController.php',
          data: {'arreglo': JSON.stringify(arreglo)},//capturo array     
          success: function(data){
         
           if(data==1){
            alertify.confirm('Comercio Internacional', 'Visibilidad Actualizada ', function(){  window.location.href = "?r=asignarSlider" }
                , function(){ alertify.error('Cancel')});
           }else{
            alertify.alert('Comercio Internacional', 'Error', function(){ alertify.error('Tiene que activar por lo menos 1. Contacte con el administrador'); });

           }
        }
});
        });
        </script>
    <script>
  $(document).ready(function(){
    addAEvent();
var formData = new FormData();
formData.append('traer',1);
    $.ajax({
                data:  formData, //datos que se envian a traves de ajax
                url:   'app/Controllers/SliderController.php', //archivo que recibe la peticion
                type:  'post',
                contentType: false,
                processData: false,
                 //método de envio
                
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                cad="";
                    var datos= JSON.parse(response);
                    for(item  of datos){
                        if(item['visible']==0){
                            $("#lista").append('<li class="list-group-item desactivado"   id="'+item['id']+'">'+item['titulo']+'</li>');
            }else{
                $("#lista2").append('<li class="list-group-item activado"   id="'+item['id']+'">'+item['titulo']+'</li>');
            }
             } $("#lista").append(cad);
             addAEvent();
                }
            });    });
    </script>
    <script>
        function addAEvent(){

$('.activado').unbind();
$('.desactivado').unbind();
var divs = document.getElementsByClassName("list-group-item desactivado"); 
var numDivs = divs.length; 
var c = 0; 
for(var i = 0; i < numDivs; i++){
  if(divs[i].className == "list-group-item desactivado") 
  c++;
} 

$(".desactivado").click(function(){
    var divs = document.getElementsByClassName("list-group-item activado"); 
var numDivs = divs.length; 
var c = 0; 
for(var i = 0; i < numDivs; i++){
  if(divs[i].className == "list-group-item activado") 
  c++;
} 
   
   // console.log("desactivado");
    var a=$(this).attr('class');
   // console.log(a);
    if(a=='list-group-item desactivado'){
        if(c<6){
        $(this).removeClass('list-group-item desactivado');
    $(this).addClass('list-group-item activado');
    $('#lista2').append(this);
}else{
        alert('No se permiten  6 elementos')
}
   
    }else if(a=='list-group-item activado'){
        $(this).removeClass('list-group-item activado');
    $(this).addClass('list-group-item desactivado');
    $('#lista').append(this);
  
    }
   /* }*/
 
   
    });
    $(".activado").click(function(){
        var a=$(this).attr('class');
    //console.log(a);
    if(a=='list-group-item desactivado'){
        $(this).removeClass('list-group-item desactivado');
    $(this).addClass('list-group-item activado');
    $('#lista2').append(this);
   
    }else if(a=='list-group-item activado'){
        $(this).removeClass('list-group-item activado');
    $(this).addClass('list-group-item desactivado');
    $('#lista').append(this);
  
    }
   
    });

  
}





  
    </script>
    
<?php
include('./views/admin/shared/footer.php');
}

