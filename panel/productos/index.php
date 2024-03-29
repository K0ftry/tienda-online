<?php
/**
 * interfaz que muestra productos al administrador
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
            <li>
              <a href="../pedidos/index.php" class="btn">Pedidos</a>
            </li>
            <li class="active">
              <a href="" class="btn">Productos</a>
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
          <div class="pull-right">
            <a href="form_registrar.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"> 
            </span>Nuevo</a>
          </div>
        </div>
     </div> 

     <div class="row">
        <div class="col-md-12">
          <fieldset>
            <legend>Listado de productos</legend>

            <form class="navbar-form navbar-left" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <input maxlength="30" type="text" name="buscador" placeholder="Buscar...">
            </div>
            <div class="form-group">
            <div class="input-group mb-3">
                <select class="custom-select" style="padding-top: 2px; padding-bottom: 2px;" id="inputGroupSelect02" name="select">
                  <option disabled selected>Escoge una opción</option>
                  <option value="1">Nombre de producto</option>
                  <option value="2">Código de producto</option>
                </select>  
            </div>
            </div>
                <button class="btn btn-primary" style="padding: 0;" type="submit">Buscar</button>
            </form> 

            <?php  
              require '../../vendor/autoload.php';

              $producto = new Tienda\Producto;
              $text = "";
              if($_SERVER['REQUEST_METHOD'] ==='POST'){
                if(isset($_POST['buscador']) and !empty($_POST['buscador']) and isset($_POST['select']) and !empty($_POST['select'])){

                  $text = $_POST['buscador'];
              
                  if($_POST['select'] == 1){
                      $rsp = $producto->buscarProducto($text);
               
                  }elseif($_POST['select'] == 2){
                      $rsp = $producto->mostrarPorIdProductoArray($text);
                  }
                }else{
                  $rsp = $producto->mostrarPorMenorStock();
                }
              }else{
                $rsp = $producto->mostrarPorMenorStock();
              }
                  
              
            ?>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th>Precio</th>
                  <th>Stock</th>
                  <th class="text-center">Foto</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  //require '../../vendor/autoload.php';
                  //$producto = new Tienda\Producto;
                  //$info_producto = $producto->mostrar();
                 
                  $cantidad = count($rsp);
                  if($cantidad > 0){
                    $c=0;
                    for($x =0; $x < $cantidad; $x++){
                      $c++;
                      $item = $rsp[$x];
                ?>

                <tr>
                  <td><?php print $c?></td>
                  <td><?php print $item['id'] ?></td>
                  <td><?php print $item['nombre']?></td>
                  <td><?php print $item['categoria_nombre']?></td>
                  <td><?php print $item['precio']?></td>
                  <td><?php print $item['stock']?></td>
                  <td class="text-center">
                      <?php
                        $foto = '../../upload/'.$item['foto'];
                        if(file_exists($foto)){
                      ?>
                        <img src="<?php print $foto; ?>" width="50">
                    <?php }else{ ?>
                        SIN FOTO
                    <?php } ?>

                  </td>
                  <td class="text-center">
                    <a href="../acciones.php?id=<?php print $item['id']?>" class="btn btn-danger btn-sm">
                    <span class="glyphicon glyphicon-trash"> </span></a>
                    <a href="form_actualizar.php?id=<?php print $item['id']?>" class="btn btn-success btn-sm">
                    <span class="glyphicon glyphicon-edit"> </span></a>
                 </td>
                </tr>

                  <?php
                    }
                    }else{

                  ?>

                  <tr>
                    <td colspan="8">NO HAY REGISTROS</td>
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
