<?php 
/**
 * interfaz de carrito
 */

//activar las sesiones en php
session_start();
require 'funciones.php';

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = $_GET['id'];

    require 'vendor/autoload.php';

$producto = new Tienda\Producto;
$resultado = $producto-> mostrarPorId($id);

if(!$resultado)
header('Location: index.php');

//si el carrito existe
if(isset($_SESSION['carrito'])){  
    //si el producto existe en el carrito
    if(array_key_exists($id,$_SESSION['carrito'])){
        actualizarProducto($id);
        //si el producto no existe en el carrito
    }else{
        agregarProducto($resultado, $id);
    }
}else{  //si el carrito no existe
    agregarProducto($resultado, $id);  
}
}

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
              <a href="" class="btn">CARRITO <span class="badge"><?php print cantidadProductos(); ?></span></a>
            </li> 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" id="main">
      
    <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Producto</th>
                  <th>Foto</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
                    $c = 0;
                    foreach($_SESSION['carrito'] as $indice => $value){
                      $c++;
                      $total = $value['precio'] * $value['cantidad'];
                ?>
                  <tr>
                    <form name="myform" action="actualizar_carrito.php" method="POST" >
                      <td><?php print $c ?></td>
                    <td><?php print $value['nombre'] ?></td>
                    <td>
                    <?php
                       $foto = 'upload/'.$value['foto'];
                       if(file_exists($foto)){
                     ?>
                        <img src="<?php print $foto; ?>" width="35">
                     <?php }else{ ?>
                         <img src="assets/imagenes/not-found.jpg" width="35">
                     <?php } ?>
                    </td>
                    <td><?php print $value['precio'] ?> CLP</td>
                    <td>
                      <input type="hidden" name="id" value="<?php print $value['id'] ?>" >
                      <button onclick="restar(<?php print $value['id'] ?>)" class="btn btn-success btn-xs">-</button>
                      <input readonly id="<?php print $value['id'] ?>" style="display: inline-block; width: 54px; height: 20px" type="text" min="0" max="100" name="cantidad" class="form-control u-size-100" value="<?php print $value['cantidad'] ?>" >
                      <button onclick="sumar(<?php print $value['id'] ?>)" class="btn btn-success btn-xs">+</button>
                    </td>
                    <td>
                      <?php print $total ?> CLP
                    </td>
                    <td class="text-center">
                     <!-- <button type="submit" class="btn btn-success btn-xs" >
                        <span class="glyphicon glyphicon-refresh" ></span>
                      </button> -->
                      <a href="eliminar_carrito.php?id=<?php print $value['id'] ?>" class="btn btn-danger btn-xs" >
                        <span class="glyphicon glyphicon-trash" ></span>
                     </a>
                    </td>
                    </form>
                  </tr>
                <?php
                }
                  }else{
                ?>
                  <tr>
                    <td colspan="7">NO HAY PRODUCTOS EN EL CARRITO</td>
                  </tr>
                <?php
                  }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="5" class="text-right">Total</td>
                  <td><?php print calcularTotal(); ?> CLP</td>
                  <td></td>
                </tr>
              </tfoot>
   </table>
   <hr>
   <?php
      if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
   ?>
      <div class="row" >
        <div class="pull-left" >
          <a href="index.php" class="btn btn-info" >Seguir comprando</a>
        </div>
        <div class="pull-right" >
        <a href="
        <?php if(isset($_SESSION['cliente_info']) && !empty($_SESSION['cliente_info'])){
          print "completar_pedido_logged.php";
        }else{
          print "finalizar.php";
        } ?>
        
        " class="btn btn-success" >Finalizar compra</a> 
        </div>
      </div>
   <?php
      }
   ?>
      

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
      function sumar(id){
        var a = parseInt(document.getElementById(id).value) + 1;
        document.getElementById(id).value = a;
        document.myform.submit();
      }
    </script>

<script>
      function restar(id){
        var a = parseInt(document.getElementById(id).value)
        if(a > 1){
          var b = a - 1;
          document.getElementById(id).value = b;
        }else{
          document.getElementById(id).value = a;
        }
        
        document.myform.submit();
      }
    </script>

  </body>
</html>
