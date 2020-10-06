<?php
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

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Las 4 Eme</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
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
                 <li><a href="clientes/cerrar_session.php">Salir</a></li>
             </ul>
            </li>
              <?php }else{ ?>
              <a href="clientes/index.php" class="btn" ><i class="far fa-user"></i></a>
              <?php } ?>
            </li> 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" id="main">
      <div class="row" >
        <?php
        require 'vendor/autoload.php';
        $producto = new Tienda\Producto;
        $info_productos = $producto ->mostrar();
        $cantidad = count($info_productos);
        if($cantidad > 0){
          for($x =0; $x<$cantidad; $x++){
            $item = $info_productos[$x];
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
              <img src="<?php print $foto; ?>" class="img-responsive">
           <?php }else{ ?>
              <img src="assets/imagenes/not-found.jpg" class="img-responsive">
             <?php } ?>
             <h4 class="text-center">Precio: $<?php print $item['precio'] ?></h6>
            </div>
            <div class="panel-footer" >
                  <a href="carrito.php?id=<?php print $item['id'] ?>" class="btn btn-success btn-block" >
                  <span class="glyphicon glyphicon-shopping-cart" ></span>Comprar
                  </a> 
            </div>
          </div>
        </div>
        <?php }
          }else{ ?>
        NO HAY REGISTROS
        <?php }?>

      </div>
      

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

  </body>
</html>
