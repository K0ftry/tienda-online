
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
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
    
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
          <a class="navbar-brand" href="../index.php?pagina=1">Las 4 Eme</a>
        </div>
       
      </div>
    </nav>

    <div class="container" id="main">
        
            <div class="row" >
                <div class="col-md-4">
                 <div class="main-login">
            <form action="login.php" method="POST">
                <div class="panel panel-default">
                     <div class="panel-heading">
                         <h3 class="text-center">INICIAR SESIÓN</h3>
                     </div>
                     <div class="panel-body">
                        <p class="text-center">
                            <img src="../assets/imagenes/logo.png" alt="">
                        </p>
                        <div class="form-group">
                            <label>Correo</label>
                            <input type="text" class="form-control" name="correo" placeholder="alguien@123.com" 
                            required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="clave" placeholder="*********" 
                            required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">INICIAR SESIÓN</button>
                     </div>
                 </div>
              </form>
                     </div>
                </div>
                <div class="col-md-4"><h4 class="text-center">Inicia sesión ó regístrate</h4></div>
                <div class="col-md-4" >
                    <fieldset>
                        <legend>Completar datos</legend>
                        <form action="registrar_cliente.php" method="POST">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input onkeypress="return check(event)" maxlength="30" type="text" class="form-control" name="nombres" required>
                        </div>
                        <div class="form-group">
                            <label>Apellidos</label>
                            <input onkeypress="return check(event)" maxlength="30" type="text" class="form-control" name="apellidos" required>
                        </div>
                        <div class="form-group">
                            <label>Correo</label>
                            <input maxlength="30" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" name="clave" class="form-control" rows="4" required></input>
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input maxlength="15" type="number" class="form-control" name="telefono" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" >Enviar</button>
                        </form>
                    </fieldset>
                </div>
            </div>
        
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script>
      function check(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
    }
    </script>

  </body>
</html>
