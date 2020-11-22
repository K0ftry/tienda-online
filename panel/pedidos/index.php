<?php
/**
 * interfaz que muestra pedidos
 */
session_start();

if(!isset($_SESSION['usuario_info']) OR empty($_SESSION['usuario_info']))
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
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
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
            <legend>Listado de pedidos</legend>
            <form class="navbar-form navbar-left" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <input maxlength="30" type="text" name="buscador" placeholder="Buscar...">
            </div>
            <div class="form-group">
            <div class="input-group mb-3">
                <select class="custom-select" style="padding-top: 2px; padding-bottom: 2px;" id="inputGroupSelect02" name="select">
                  <option disabled selected>Escoge una opción</option>
                  <option value="1">Cliente</option>
                  <option value="2">N° de pedido</option>
                  <option value="3">Total</option>
                  <option value="4">Fecha</option>
                </select>  
            </div>
            </div>
                <button class="btn btn-primary" style="padding: 0;" type="submit">Buscar</button>
            </form> 

            <?php  
              require '../../vendor/autoload.php';

              $pedido = new Tienda\Pedido;
              $text = "";
              if($_SERVER['REQUEST_METHOD'] ==='POST'){
                if(isset($_POST['buscador']) and !empty($_POST['buscador']) and isset($_POST['select']) and !empty($_POST['select'])){

                  $text = $_POST['buscador'];
              
                  if($_POST['select'] == 1){
                      $rsp = $pedido->buscarPorCliente($text);
               
                  }elseif($_POST['select'] == 2){
                      $rsp = $pedido->mostrarPorIdBuscador($text);
              
                  }elseif($_POST['select'] == 3){
                      $rsp = $pedido->buscarPorTotal($text);
              
                  }elseif($_POST['select'] == 4){
                      $rsp = $pedido->buscarPorFecha($text);
                  }
                }else{
                  $rsp = $pedido->mostrar();
                }
              }else{
                $rsp = $pedido->mostrar();
              }
                  
              
            ?>
            
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Cliente</th>
                  <th>N° de pedido</th>
                  <th>Total</th>
                  <th>Fecha</th>
                  <th>Entregado</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  //require '../../vendor/autoload.php';
                  //$pedido = new Tienda\Pedido;
                  //$info_pedido = $pedido->mostrar(); 
                 
                  $cantidad = count($rsp);
                  if($cantidad > 0){
                    $c=0;
                    for($x =0; $x < $cantidad; $x++){
                      $c++;
                      $item = $rsp[$x];
                ?>

                <tr>
                <form action="../accion_pedidos.php" method="POST" enctype="multipart/form-data" name="form">
                  <td><?php print $c?></td>
                  <td><?php print $item['nombres'].' '.$item['apellidos']?></td> 
                  <td>
                    <?php print $item['id']?>
                    <input type="hidden" name="id" value="<?php print $item['id'] ?>">
                  </td>
                  <td><?php print $item['total']?> CLP</td>
                  <td><?php print $item['fecha']?></td>
                  <td class="text-center">
                   <input type="hidden" name="estado" value="<?php print $item['entregado'] ?>">
                    <span>
                    <?php if ($item['entregado'] == 1 ){
                               print "✔Sí";
                           }else{
                               print "No";
                               }
                     ?>
                    </span>
                           <button type="submit">
                           <i class="fas fa-exchange-alt"></i>
                           </button>
                      
                    
                  <!-- <input type="checkbox" checked data-toggle="toggle" data-on="Sí" data-off="No" data-onstyle="success" data-offstyle="danger" data-size="mini"> -->
                      
                  </td>
                  
                  <td class="text-center">
                    <a href="ver.php?id=<?php print $item['id']?>" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-eye-open"> </span></a>  
                 </td>
                           

                 </form>
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
          </fieldset>
        </div>
     </div> 

     
    
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

  </body>
</html>
