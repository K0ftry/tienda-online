<?php
/**
 * interfaz entre vista y controlador
 */
require '../vendor/autoload.php';

$producto = new Tienda\Pedido;

if($_SERVER['REQUEST_METHOD'] ==='POST'){
    $text = $_POST['buscador'];

    if($_POST['select'] === 1){
        $rsp = $producto->buscarPorCliente($text);
        return $rsp;

    }elseif($_POST['select'] === 2){
        $rsp = $producto->mostrarPorId($text);
        return $rsp;

    }elseif($_POST['select'] === 3){
        $rsp = $producto->buscarPorTotal($text);
        return $rsp;

    }elseif($_POST['select'] === 4){
        $rsp = $producto->buscarPorFecha($text);
        return $rsp;
    }

}