<?php
session_start();
require 'vendor/autoload.php';
$producto = new Tienda\Producto;

if($_SERVER['REQUEST_METHOD'] ==='POST'){
    require 'funciones.php';
    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];

    $productoId = $producto->mostrarPorId($id);

    if(is_numeric($cantidad)){
        if(array_key_exists($id,$_SESSION['carrito'])){
            if($productoId['stock'] >= $cantidad){
                actualizarProducto($id,$cantidad);
            }
        }    
    }
    header('Location: carrito.php'); 
}