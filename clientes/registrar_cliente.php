<?php

session_start();

if($_SERVER['REQUEST_METHOD'] ==='POST'){

    require '../vendor/autoload.php';

        $cliente = new Tienda\Cliente;

        $_params = array(
        'nombres' => $_POST['nombres'],
        'apellidos' => $_POST['apellidos'],
        'email' => $_POST['email'],
        'clave' => $_POST['clave'],
        'telefono' => $_POST['telefono']
        );
    
        //esta validación es para evitar que se registre el mismo correo más de una vez
        if($cliente->validarSiExisteCorreo($_POST['email'])){
            echo "<script>
                        alert('Error este correo ya se encuentra registrado');
                        window.location= 'index.php'
            </script>";
        }else{
            $cliente->registrar($_params); 
        
        echo "<script>
                        alert('Cliente registrado exitosamente');
                        window.location= '../index.php'
            </script>";
        }
              
   
}else{
    print "Error al registrar cliente";
}



