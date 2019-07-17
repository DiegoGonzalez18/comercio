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
     <div class="card-header">Comercio
         <strong>Internacional</strong>
     </div>
 <div class="card-body">
   
</div>
</main>
        <!-- /Fin del contenido principal -->
    </div>
<?php
include('./views/admin/shared/footer.php');
}

