<?php
/**
 * registra pedido y detalle, descuenta stock
 */

session_start();


    require 'funciones.php';
    require 'vendor/autoload.php';

    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito']) && isset($_SESSION['cliente_info']) && !empty($_SESSION['cliente_info'])){
    
        $pedido = new Tienda\Pedido;

        $_params = array(
            'cliente_id' => $_SESSION['cliente_info']['id_cliente'],
            'total' => calcularTotal(),
            'fecha' => date('Y-m-d')
        );
    
        $pedido_id = $pedido -> registrar($_params);

        $producto = new Tienda\Producto;

        foreach($_SESSION['carrito'] as $indice => $value){
            $_params = array(
                "pedido_id" =>$pedido_id,
                "producto_id" =>$value['id'],
                "precio" =>$value['precio'],
                "cantidad" =>$value['cantidad']
            );
            $pedido -> registrarDetalle($_params);
            $producto -> descontarStock($value['id'],$value['cantidad']);
        }
        $_SESSION['carrito'] = array();
        header('Location: gracias.php?id='.$pedido_id);
    }else{
        print "No logueado o carrito vacío";
    }
   
