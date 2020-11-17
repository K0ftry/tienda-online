<?php
/**
 * interfaz mostrada al finalizar compra
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
    <!-- oculta contenido que no se desea imprimir -->
    <style type="text/css" media="print">
        @media print {
        #mensaje {display:none;}
        }
    </style>

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
       
      </div>
    </nav>

    <div class="container" id="main">
      <div class="row" >
          <div id="mensaje" class="jumbotron" >
            <p class="text-center">Gracias por su compra</p> 
            <p class="text-center">No olvide mostrar este comprobante al momento de retirar sus productos, puede descargarlo o imprimirlo al final de la página</p>
            <p class="text-center"><small>Consultas al fono: +56911111111</small></p>
          </div>
           
      </div>
      <!--info del pedido -->
      <div class="row">
        <div class="col-md-12"> 
          <fieldset>
              <?php
                require 'vendor/autoload.php';
                $id = $_GET['id'];
                $pedido = new Tienda\Pedido;
                $info_pedido = $pedido->mostrarPorIdVer($id);  
                $info_detalle_pedido = $pedido->mostrarDetallePorIdPedido($id);
                ?>
              <legend>Información de la compra</legend>
              <div class="form-group" >
                <label>Nombre</label>
                <input value="<?php print $info_pedido['nombres'] ?>" type="text" class="form-control" readonly>
              </div>
              <div class="form-group" >
                <label>Apellidos</label>
                <input value="<?php print $info_pedido['apellidos'] ?>" type="text" class="form-control" readonly>
              </div>
              <div class="form-group" >
                <label>Email</label>
                <input value="<?php print $info_pedido['email'] ?>" type="text" class="form-control" readonly>
              </div>
              <div class="form-group" >
                <label>Fecha</label>
                <input value="<?php print $info_pedido['fecha'] ?>" type="text" class="form-control" readonly>
              </div>
              <hr>
                 Productos comprados
              <hr>
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Foto</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $cantidad = count($info_detalle_pedido);
                  if($cantidad > 0){
                    $c=0;
                    for($x =0; $x < $cantidad; $x++){
                      $c++;
                      $item = $info_detalle_pedido[$x];
                      $total = $item['precio'] * $item['cantidad'];
                ?>

                <tr>
                  <td><?php print $c?></td>
                  <td><?php print $item['nombre']?></td>
                  <td>
                  <?php
                        $foto = 'upload/'.$item['foto'];
                        if(file_exists($foto)){
                      ?>
                        <img src="<?php print $foto; ?>" width="35">
                    <?php }else{ ?>
                        SIN FOTO
                    <?php } ?>
                  </td>
                  <td><?php print $item['precio']?> CLP</td>
                  <td><?php print $item['cantidad']?></td>
                  <td><?php print $total?></td>
                </tr>

                  <?php
                    }
                    }else{

                  ?>

                  <tr>
                    <td colspan="6">NO HAY REGISTROS</td>
                  </tr>

                    <?php }?>

                  

              </tbody>
            </table>
            <div class="col-md-3">
                <div class="form-group" >
                    <label>Total compra</label>
                    <input value="<?php print $info_pedido['total'] ?>" type="text" class="form-control" readonly>
                </div>
            </div>
          </fieldset>
          <div class="pull-left">
             <a href="index.php" class="btn btn-default hidden-print">Regresar</a>
          </div>
          <div class="pull-right">
             <a href="javascript:;" id="btnImprimir" class="btn btn-primary hidden-print">Descargar o imprimir</a>
          </div>
          
        </div>
     </div> 
      <!--info del pedido -->
      

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
      $('#btnImprimir').on('click', function(){
        window.print();
        return false;
      })
    </script>

  </body>
</html>
