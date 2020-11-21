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
    
    <?php 
    setlocale(LC_ALL,"es_ES");
    date_default_timezone_set("America/Santiago");
    $dia_actual = date("d");
    $mes_actual = date("m");
    $ano_actual = date("Y");
    $fecha_actual = date("d-m-Y");
    $hora_actual = date("G:i:s");
    ?>
    <div class="row">
        <div class="col-md-12"> 
          <fieldset>
            <legend class="text-center">Ventas</legend>
            <div class="row">
              <div class="col-md-12">
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th></th>
                  <th>Hoy <?php print $fecha_actual ?></th>
                  <th>Este mes</th>
                  <th>Mes anterior</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                   <th>Cantidad de ventas</th>
                   <th></th>
                   <th></th>
                   <th></th>
                </tr>
                <tr>
                    <th>Total vendido</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>  
              </tbody>
              </table>
              </div>
            </div>
          </fieldset>
        </div>
     </div>
     <div class="row">
       <div class="col-md-6">
         <p>Cantidad vendida en relación al mes anterior: </p>
       </div>
       <div class="col-md-6">
         <p>Total vendido en relación al mes anterior: </p>
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
