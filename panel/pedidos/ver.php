<?php
/**
 * interfaz que muestra el detalle de un pedido
 */
session_start();

if(!isset($_SESSION['usuario_info']) OR empty($_SESSION['usuario_info']))
    header('Location: ../../index.php?pagina=1');
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
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/estilos.css">
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
          <a class="navbar-brand" href="../dashboard.php">Las 4 Eme</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
            <li>
              <a href="../informes/index.php" class="btn">Informes</a>
            </li>
            <li class="active">
              <a href="index.php" class="btn">Pedidos</a>
            </li>
            <li>
              <a href="../productos/index.php" class="btn">Productos</a>
            </li>
            <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
             aria-haspopup="true" aria-expanded="false"><?php print $_SESSION['usuario_info']['nombre_usuario']; ?> <span class="caret"></span></a>
             <ul class="dropdown-menu">
                 <li><a href="../cerrar_session.php">Salir</a></li>
             </ul>
            </li>
          </ul>




        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" id="main">
    <div class="row">
        <div class="col-md-12"> 
          <fieldset>
              <?php
                require '../../vendor/autoload.php';
                $id = $_GET['id'];
                $pedido = new Tienda\Pedido;
                $info_pedido = $pedido->mostrarPorIdVer($id);  
                $info_detalle_pedido = $pedido->mostrarDetallePorIdPedido($id);
                ?>

              <div class="row" style="margin-bottom: 10px;;">
                <div class="col-md-5">
                  <h5 style="padding: 0; margin:0;">Las 4 EME</h5>
                  <p style="line-height: 30%; padding: 0; margin:0;"><small style="font-size: 12px; margin:0;" >Panadería, rotisería,</small></p>
                  <p style="line-height: 90%; padding: 0; margin:0; "><small style="font-size: 12px; margin:0;">supermercado y fábrica de pasteles</small></p>
                  <p style="line-height: 70%; padding: 0; margin:0; "><small style="font-size: 12px; margin:0;">RUT 11.111.111.1</small></p>
                </div>
                <br>
                <br>
                <div class="col-md-7">
                    <h4 style="display: inline;">Comprobante de entrega</h4>
                </div>
              </div>
              <div class="col-md-12">
              <table class="table table-bordered table-sm" >
                <tr>
                  <td style=" padding: 0; border-color: #aaa; border-width: 3px; ">
                  <h5 class="text-center" style="margin:0;">1. Datos de cliente</h5>
                  </td>
                </tr>
                <tr>
                  <td style="padding: 0; border-color: #aaa; border-width: 3px;">
                   <div class="col-md-4 " >
                    <label>Nombre Completo</label>
                    <p><?php print $info_pedido['nombres']." ".$info_pedido['apellidos'] ?></p>
                  </div>
                  <div class="col-md-4" >
                    <label>Email</label>
                    <p><?php print $info_pedido['email'] ?></p>
                  </div>
                  <div class="col-md-4" >
                    <label>Fecha de compra</label>
                    <p><?php print $info_pedido['fecha'] ?></p>
                  </div>
                  </td>
                </tr>
                <tr>
                  <td style=" padding: 0; border-color: #aaa; border-width: 3px; "><h5 class="text-center" style="margin:0;">2. Datos de quien recibe</h5></td>
                </tr>
               <tr>
                  <td style=" padding: 0; border-color: #aaa; border-width: 3px; ">
                  <div class="col-md-4 " >
                    <label>Nombre Completo</label>
                   
                  </div>
                  <div class="col-md-4" >
                    <label>RUN</label>
                    
                  </div>
                  <div class="col-md-4" >
                    <label>Firma</label>
                    <p>x</p>
                  </div>
                  </td>
                </tr>
                <tr>
                  <td style="padding: 0; border-color: #aaa; border-width: 3px; "><h5 class="text-center" style="margin:0;">3. Detalle de pedido</h5>
                  <p class="text-center" style="margin:3px; line-height:75%; font-size: 12px; ;">Pedido N° <?php print $info_pedido['id'] ?></p>
                </td>
                </tr>
                <tr>
                  <td style="padding: 0; border-color: #aaa; border-width: 3px;">
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
                        $foto = '../../upload/'.$item['foto'];
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
                  </td>
                </tr>
              
              </table>
              </div> 
          </fieldset>
          

          <div class="pull-left">
             <a href="index.php" class="btn btn-default hidden-print">Cancelar</a>
          </div>
          <div class="pull-right">
             <a href="javascript:;" id="btnImprimir" class="btn btn-primary hidden-print">Imprimir</a>
          </div>
          
        </div>
     </div> 
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script>
      $('#btnImprimir').on('click', function(){
        window.print();
        return false;
      })
    </script>

  </body>
</html>
