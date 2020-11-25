<?php
/**
 * formulario para registrar productos
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

    <div class="container" id="main" >
      <div class="row">
          <div class="col-md-12">
              <fieldset>
                  <legend>Datos del producto</legend>
                <form method="POST" action="../acciones.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input maxlength="30" type="text" class="form-control" name="nombre" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea maxlength="100" class="form-control" name="descripcion" id="" cols="3" required style="resize: none;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Categorias</label>
                            <select class="form-control" name="categoria_id" required>
                                <option value="">--SELECCIONE--</option>

                                <?php
                                   require '../../vendor/autoload.php';
                                   $categoria = new Tienda\Categoria;
                                   $info_categoria = $categoria->mostrar();

                                   $cantidad = count($info_categoria);
                                   for($x =0; $x < $cantidad; $x++){
                                     $item = $info_categoria[$x];
                                ?>
                                    <option value="<?php print $item['id'] ?>"><?php print $item['categoria_nombre'] ?></option>
                                <?php
                                   }
                                ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="foto" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Precio</label>
                            <input onkeypress="return check(event)" min="0" step="1" type="number" class="form-control" name="precio" placeholder="0" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Stock</label>
                            <input onkeypress="return check(event)" type="number" class="form-control" name="stock" placeholder="0" required min="0" max="1000" maxlength="10" step="1">
                        </div>
                    </div>
                </div>
                
                    <input type="submit" name="accion" class="btn btn-primary" value="Registrar">
                    <a href="index.php" class="btn btn-default">Cancelar</a>
                </form>
           </fieldset>

          </div>

      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script>
      function check(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
    }
    </script>

  </body>
</html>
