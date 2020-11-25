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
            'id_cliente' => $resultado['id'],
            'nombre_cliente'=>$resultado['nombres'],
            'estado'=>1
        );

        header('Location: ../index.php?pagina=1');
    }else{
        //esta sección es para la validación del administrador
        $usuario = new Tienda\Usuario;
        $resultado = $usuario-> login($correo, $clave);

    if($resultado){
        session_start();
        $_SESSION['usuario_info'] = array(
            'nombre_usuario'=>$resultado['nombre_usuario'],
            'estado'=>1
        );

        header('Location: ../panel/dashboard.php');
    }else{
        exit(json_encode(array('estado' => FALSE, 'mensaje'=>'error al iniciar sesion')));
    }
       
    }
    
}