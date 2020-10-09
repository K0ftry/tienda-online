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
    
        $cliente->registrar($_params);
        
        echo "<script>
                        alert('Cliente registrado');
                        window.location= 'index.php'
            </script>";
   
}else{
    print "Error al registrar cliente";
}



