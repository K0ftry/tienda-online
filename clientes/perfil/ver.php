<?php
session_start();

if(!isset($_SESSION['cliente_info']) OR empty($_SESSION['cliente_info']))
    header('Location: ../../index.php');
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
          <a class="navbar-brand" href="../../index.php">Las 4 Eme</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
            <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
             aria-haspopup="true" aria-expanded="false"><?php print $_SESSION['cliente_info']['nombre_cliente']; ?> <span class="caret"></span></a>
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
                $id = $_SESSION['cliente_info']['id_cliente'];
                $cliente = new Tienda\Cliente;
                $pedido = new Tienda\Pedido;
                $info_cliente = $cliente->mostrarPorId($id); 
                $info_pedidos = $pedido->mostrarPorIdCliente($id);
                ?>
              <legend>Mi perfil</legend>
              <div class="form-group" >
                <label>Nombre</label>
                <input value="<?php print $info_cliente['nombres'] ?>" type="text" class="form-control" readonly>
              </div>
              <div class="form-group" >
                <label>Apellidos</label>
                <input value="<?php print $info_cliente['apellidos'] ?>" type="text" class="form-control" readonly>
              </div>
              <div class="form-group" >
                <label>Email</label>
                <input value="<?php print $info_cliente['email'] ?>" type="text" class="form-control" readonly>
              </div>
              <div class="form-group" >
                <label>Clave</label>
                <input value="<?php print $info_cliente['clave'] ?>" type="password" class="form-control" readonly>
              </div>
              <div class="form-group" >
                <label>Teléfono</label>
                <input value="<?php print $info_cliente['telefono'] ?>" type="text" class="form-control" readonly>
              </div>
              <hr>
                 Compras hechas
              <hr>
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Fecha</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $cantidad = count($info_pedidos);
                  if($cantidad > 0){
                    $c=0;
                    for($x =0; $x < $cantidad; $x++){
                      $c++;
                      $item = $info_pedidos[$x];
                ?>

                <tr>
                  <td><?php print $c?></td>
                  <td><?php print $item['fecha']?></td>
                  <td><?php print $item['total']?> CLP</td>
                </tr>

                  <?php
                    }
                    }else{

                  ?>

                  <tr>
                    <td colspan="3">NO HAY REGISTROS</td>
                  </tr>

                    <?php }?>

                  

              </tbody>
            </table>
          </fieldset>
          
        </div>
     </div> 
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

  </body>
</html>
