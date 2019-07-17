<!DOCTYPE html>
<html lang="es">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistema Ventas Laravel Vue Js- IncanatoIT">
  <meta name="author" content="Incanatoit.com">
  <meta name="keyword" content="Sistema ventas Laravel Vue Js, Sistema compras Laravel Vue Js">

  <title>Comercio Internacional - UFPS</title>

  <!-- Icons -->
  <link href="./views/assets/vendors/css/font-awesome.min.css" rel="stylesheet">
  <link href="./views/assets/vendors/css/simple-line-icons.min.css" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="./views/assets/vendors/css/style.css" rel="stylesheet">

</head>

<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
     
      <div class="col-md-8">
        <div class="card-group mb-0">
       
          <div class="card p-4" >
            <div class="card-body">
            <form  id="login" method="post">

              <h1>Acceder</h1><div id="respuesta">

              </div>
              <p class="text-muted">Control de acceso al sistema</p>
              <div class="input-group mb-3">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" name="email" id="email" class="form-control" placeholder="Usuario">
              </div>
              <div class="input-group mb-4">
                <span class="input-group-addon"><i class="icon-lock"></i></span>
                <input type="password" name="clave" id="clave" class="form-control" placeholder="Password">
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="button" id="enviar" class="btn btn-primary px-4">Acceder</button>
                </div>
                <div class="col-6 text-right">
                  <button type="button" class="btn btn-link px-0">Olvidaste tu password?</button>
                </div>
              </div>  </form>
            </div>
          </div>
        
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>Comercio Internacional UFPS</h2>
                <p>Aplicación para la gestión de contenido de la página del programa Comercio Internacional UFPS</p>
                <a href="#" target="_blank" class="btn btn-primary active mt-3">Ir a la página</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap and necessary plugins -->
  <script src="./views/assets/vendors/js/jquery.min.js"></script>
  <script src="./views/assets/vendors/js/popper.min.js"></script>
  <script src="./views/assets/vendors/js/bootstrap.min.js"></script>
  <script>
  $("#enviar").click(function(){

$.ajax({
                data:  $("#login").serialize(), //datos que se envian a traves de ajax
                url:   'app/Controllers/UsuarioController.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                  $("#alerta").remove()     
                        
                        $("#respuesta").append('<div id="alerta" class="alert alert-warning" role="alert">Procesando, espere por favor...</div>');
                       

                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                console.log(response );
                     if(!response){

                       $("#alerta").remove()                      
                        $("#respuesta").append('<div id="alerta" class="alert alert-danger" role="alert">Error al intentar ingresar</div>');
                       

                      } else {
                         
                          window.location.href = '?r=home';
                      }
                }
        });

  });
  
  
  </script>

</body>
</html>