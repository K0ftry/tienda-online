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
    $fecha_actual = date("Y-m-d");
    $fecha_mes_anterior = date("Y-m-d", strtotime("-1 month"));
    $fecha_actual_1 = date("Y-m-d", strtotime("-1 days"));
    $fecha_actual_2 = date("Y-m-d", strtotime("-2 days"));
    $fecha_actual_3 = date("Y-m-d", strtotime("-3 days"));
    $fecha_actual_4 = date("Y-m-d", strtotime("-4 days"));
    $fecha_actual_5 = date("Y-m-d", strtotime("-5 days"));
    $fecha_actual_6 = date("Y-m-d", strtotime("-6 days"));
    $fecha_actual_7 = date("Y-m-d", strtotime("-7 days"));
    $hora_actual = date("G:i:s");

    require '../../vendor/autoload.php';
              $pedido = new Tienda\Pedido;
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
                   <td>
                     <?php $array = $pedido->buscarPorFecha($fecha_actual);
                     $pedidos_hoy = $array;
                     print count($array);
                      ?>
                   </td>
                   <td>
                   <?php $array = $pedido->buscarPorMes($fecha_actual);
                     $pedidos_mes = $array;
                     print count($array);
                      ?>
                   </td>

                   <td>
                   <?php $array = $pedido->buscarPorMes($fecha_mes_anterior);
                     $pedidos_mes_anterior = $array;
                     print count($array);
                      ?>
                   </td>
                </tr>
                <tr>
                    <th>Total vendido</th>
                    <td><?php
                    $total = 0;
                    foreach($pedidos_hoy as $value){
                      $total = $value['total'] + $total;
                    } 
                    print $total;
                    ?></td>
                    
                    <td><?php
                    $total = 0;
                    foreach($pedidos_mes as $value){
                      $total = $value['total'] + $total;
                      $total_mes = $total;
                    } 
                    print $total;
                    ?></td>
                    
                    <td><?php
                    $total = 0;
                    foreach($pedidos_mes_anterior as $value){
                      $total = $value['total'] + $total;
                      $total_mes_anterior = $total;
                    } 
                    print $total;
                    ?></td>
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
         <p>Cantidad vendida en relación al mes anterior: 
           <?php if($pedidos_mes >= $pedidos_mes_anterior){
             print "+".round(((((count($pedidos_mes)*100)/count($pedidos_mes_anterior)))-100), 2)."%";
         }else{
             print round((((count($pedidos_mes)*100)/count($pedidos_mes_anterior))-100), 2)."%";
         } 
         ?></p>
       </div>
       <div class="col-md-6">
         <p>Total vendido en relación al mes anterior: 
         <?php if($total_mes >= $total_mes_anterior){
             print "+".round(((($total_mes*100)/$total_mes_anterior)-100), 2)."%";
         }else{
             print round(((($total_mes*100)/$total_mes_anterior)-100), 2)."%";
         } 
         ?>
         </p>
       </div>       
     </div>
     <hr>
     <div class="row">
       <h4 class="text-center">Ventas de los últimos 7 días</h4>
       <div class="col-md-12">
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th></th>
                  <th><?php print $fecha_actual_1 ?></th>
                  <th><?php print $fecha_actual_2 ?></th>
                  <th><?php print $fecha_actual_3 ?></th>
                  <th><?php print $fecha_actual_4 ?></th>
                  <th><?php print $fecha_actual_5 ?></th>
                  <th><?php print $fecha_actual_6 ?></th>
                  <th><?php print $fecha_actual_7 ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                   <th>Cantidad de ventas</th>
                   <td>
                     <?php $array = $pedido->buscarPorFecha($fecha_actual_1);
                     $total_fecha_actual_1 = $array;
                     print count($array);
                      ?>
                   </td>
                   <td>
                     <?php $array = $pedido->buscarPorFecha($fecha_actual_2);
                     $total_fecha_actual_2 = $array;
                     print count($array);
                      ?>
                   </td>
                   <td>
                     <?php $array = $pedido->buscarPorFecha($fecha_actual_3);
                     $total_fecha_actual_3 = $array;
                     print count($array);
                      ?>
                   </td>
                   <td>
                     <?php $array = $pedido->buscarPorFecha($fecha_actual_4);
                     $total_fecha_actual_4 = $array;
                     print count($array);
                      ?>
                   </td>
                   <td>
                     <?php $array = $pedido->buscarPorFecha($fecha_actual_5);
                     $total_fecha_actual_5 = $array;
                     print count($array);
                      ?>
                   </td>
                   <td>
                     <?php $array = $pedido->buscarPorFecha($fecha_actual_6);
                     $total_fecha_actual_6 = $array;
                     print count($array);
                      ?>
                   </td>
                   <td>
                     <?php $array = $pedido->buscarPorFecha($fecha_actual_7);
                     $total_fecha_actual_7 = $array;
                     print count($array);
                      ?>
                   </td>
                </tr>
                <tr>
                    <th>Total vendido</th>
                    <td><?php
                    $total = 0;
                    foreach($total_fecha_actual_1 as $value){
                      $total = $value['total'] + $total;
                    } 
                    print $total;
                    ?></td>

                    <td><?php
                    $total = 0;
                    foreach($total_fecha_actual_2 as $value){
                      $total = $value['total'] + $total;
                    } 
                    print $total;
                    ?></td>

                    <td><?php
                    $total = 0;
                    foreach($total_fecha_actual_3 as $value){
                      $total = $value['total'] + $total;
                    } 
                    print $total;
                    ?></td>

                    <td><?php
                    $total = 0;
                    foreach($total_fecha_actual_4 as $value){
                      $total = $value['total'] + $total;
                    } 
                    print $total;
                    ?></td>

                    <td><?php
                    $total = 0;
                    foreach($total_fecha_actual_5 as $value){
                      $total = $value['total'] + $total;
                    } 
                    print $total;
                    ?></td>

                    <td><?php
                    $total = 0;
                    foreach($total_fecha_actual_6 as $value){
                      $total = $value['total'] + $total;
                    } 
                    print $total;
                    ?></td>

                    <td><?php
                    $total = 0;
                    foreach($total_fecha_actual_7 as $value){
                      $total = $value['total'] + $total;
                    } 
                    print $total;
                    ?></td>
                </tr>  
              </tbody>
              </table>
              </div>
     </div>
     <hr>
     <div class="row">
       <legend class="text-center">Alertas</legend>
       <div class="col-md-6">
         <p>Pedidos no entregados: <a href="../pedidos/index.php">ver pedidos</a></p>
       </div>
       <div class="col-md-6">
         <p>Productos sin stock: <a href="../productos/index.php">ver productos</a></p>
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
