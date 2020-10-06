<?php

if($_SERVER['REQUEST_METHOD'] ==='POST'){
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    require '../vendor/autoload.php';

    $cliente = new Tienda\Cliente;
    $resultado = $cliente-> login($correo, $clave);

    if($resultado){
        session_start();
        $_SESSION['cliente_info'] = array(
            'nombre_cliente'=>$resultado['nombres'],
            'estado'=>1
        );

        header('Location: ../index.php');
    }else{
        exit(json_encode(array('estado' => FALSE, 'mensaje'=>'error al iniciar sesion')));
    }
    
}