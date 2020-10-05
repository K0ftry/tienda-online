<?php

require '../vendor/autoload.php';

$pedido = new Tienda\Pedido;

if($_SERVER['REQUEST_METHOD'] ==='POST'){


    $respuesta = $pedido->actualizarEntregado($_POST['id'], $_POST['estado']);

    if($respuesta)
        header('Location: pedidos/index.php');
    else
        print 'Error al actualizar pedido'; 



}