<?php
/**
 * interfaz que muestra productos
 */
session_start();
require 'funciones.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Las 4 Eme</title>
    

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

  </head>

  <body>

    

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="categorias/despensa.php">Despensa</a>
  <a href="categorias/snacks.php">Snacks</a>
  <a href="categorias/bebidas.php">Bebidas, Jugos y Aguas</a>
  <a href="categorias/vinos.php">Vinos y Licores</a>
  <a href="categorias/lacteos.php">Lácteos</a>
  <a href="categorias/congelados.php">Congelados</a>
  <a href="categorias/aseo.php">Aseo y Limpieza</a>
</div>


<!-- fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Las 4 Eme</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categorías <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="categorias/despensa.php">Despensa</a></li>
            <li><a href="categorias/snacks.php">Snacks</a></li>
            <li><a href="categorias/bebidas.php">Bebidas, Jugos y Aguas</a></li>
            <li><a href="categorias/vinos.php">Vinos y Licores</a></li>
            <li><a href="categorias/lacteos.php">Lácteos</a></li>
            <li><a href="categorias/congelados.php">Congelados</a></li>
            <li><a href="categorias/aseo.php">Aseo y Limpieza</a></li>
          </ul>
        </li>
      </ul>
      <form  class="navbar-form navbar-left" action="" method="POST" enctype="multipart/form-data"> 
        <div class="form-group">
          <input onkeypress="return check(event)" maxlength="30" type="text" class="form-control" placeholder="Buscar producto" name="buscador">
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li>
           <a href="carrito.php" class="btn">CARRITO <span class="badge"><?php print cantidadProductos(); ?></span></a>
        </li>
        <li>
              <?php 
              if(isset($_SESSION['cliente_info']) AND !empty($_SESSION['cliente_info'])){
              ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
              aria-haspopup="true" aria-expanded="false"><?php print $_SESSION['cliente_info']['nombre_cliente']; ?><span class="caret"></span></a>
              <ul class="dropdown-menu">
                 <li><a href="clientes/perfil/ver.php">Mi Perfil</a></li>
                 <li><a href="clientes/cerrar_session.php">Salir</a></li>
              </ul>
            </li>
              <?php }else{ ?>
              <a href="clientes/index.php" class="btn" ><i class="far fa-user"></i></a>
              <?php } ?>
        </li> 
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div id="main-index">
    <!-- Carousel -->
    <div class="row-fluid">
       <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
       <div id="myCarousel" class="carousel slide" data-ride="carousel">
               <!-- Indicators -->
             <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
             </ol>
          
                  <!-- Wrapper for slides -->
               <div class="carousel-inner">
                   <div class="item active">
                     <img src="assets/imagenes/carousel1.png" alt="Oferta 1">
               </div>
          
                <div class="item">
                   <img src="assets/imagenes/carousel2.png" alt="Oferta 2">
                </div>
          
                <div class="item">
                     <img src="assets/imagenes/carousel3.png" alt="Oferta 3">
                 </div>
                </div>
          
                <!-- Left and right controls -->
                 <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                   <span class="sr-only">Anterior</span>
                 </a>
                 <a class="right carousel-control" href="#myCarousel" data-slide="next">
                   <span class="glyphicon glyphicon-chevron-right"></span>
                   <span class="sr-only">Siguiente</span>
                 </a>
              </div>
                          
         </div>
         
      <!-- Carousel -->
    <br>
    <div class="container">
    
      <div class="row">
      <?php  
              require 'vendor/autoload.php';

              $producto = new Tienda\Producto;
              $text = "";
              if($_SERVER['REQUEST_METHOD'] ==='POST'){
                if(isset($_POST['buscador']) and !empty($_POST['buscador'])){

                  $text = $_POST['buscador'];
                      $rsp = $producto->buscarProducto($text);
                }else{
                  $rsp = $producto->mostrar();
                }
              }else{
                $rsp = $producto->mostrar();
              }
                  
      
        $cantidad = count($rsp);
        if($cantidad > 0){
          for($x =0; $x<$cantidad; $x++){
            $item = $rsp[$x];
        ?>
        <div class="col-md-3" >
          <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="text-center nombre-producto" ><?php print $item['nombre'] ?></h1>
          </div>
            <div class="panel-body">
            <?php
             $foto = 'upload/'.$item['foto'];
             if(file_exists($foto)){
            ?>
              <a href="descripcion.php?id=<?php print $item['id'] ?>"><img src="<?php print $foto; ?>" class=" img-responsive"></a>     
           <?php }else{ ?>
              <img src="assets/imagenes/not-found.jpg" class="img-responsive">
             <?php } ?>
             <h4 class="text-center">Precio: $<?php print $item['precio'] ?></h6>
            </div>
            <?php 
            if($item['stock'] == 0){
              ?>
              <div class="panel-footer">
                  <a href="" class="btn btn-white btn-block disabled text-danger">Sin Stock</a>
              </div>
             

            <?php 
            }else{
              ?>
            <div class="panel-footer" > 
                  <a href="carrito.php?id=<?php print $item['id'] ?>" class="btn btn-success btn-block" >
                  <span class="glyphicon glyphicon-shopping-cart" ></span>Agregar
                  </a> 
            </div>
            <?php } ?>
          </div>
        </div>
        <?php }
          }else{ ?>
        NO HAY REGISTROS
        <?php }?>

      </div>
      
    </div> <!-- /container -->
</div>

<div class="container" style="bottom: 0; width: 100%">
  <div class="row">
    <div class="col">
      <!-- Footer -->
<footer class="page-footer font-small teal pt-4">
<div class="container-fluid text-center text-md-left bg-primary">
  <div class="row">
  <hr class="clearfix w-100 d-md-none pb-3">
    <div class="col-md-6 mt-md-0 mt-3">
      <h6 class="text-uppercase font-weight-bold">INFORMACIÓN AL CLIENTE</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a href="#!">Términos y condiciones</a>
        </p>
        <p>
          <a href="#!">Politicas de privacidad</a>
        </p>
        <p>
          <a href="#!">Quienes somos</a>
        </p>
        <p>
          <a href="#!">Preguntas Frecuentes</a>
        </p>
    </div>
    
    <div class="col-md-6 mb-md-0 mb-3">
      
        <h6 class="text-uppercase font-weight-bold">CONTACTO</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <i class="fas fa-home mr-3"></i> Yungay, Esmeralda 576, CL</p>
        <p>
          <i class="fas fa-envelope mr-3"></i> info@las4eme.cl</p>
        <p>
          <i class="fas fa-phone mr-3"></i> + 56911223344</p>
        <p>
          <i class="fab fa-facebook-f"></i> Las 4 Eme</p>
    </div>
  </div>
</div>
<div class="footer-copyright text-center py-3">© 2020 Copyright:
  <a href=""> Las 4 Eme</a>
</div>
</footer>
<!-- Footer -->
    </div>
  </div>
</div>
    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script>
      function check(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
    }
    </script>

            
  </body>
</html>
