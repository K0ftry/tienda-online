<?php 
/**
 * interfaz de carrito
 */

//activar las sesiones en php
session_start();
require '../funciones.php';

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = $_GET['id'];

    require '../vendor/autoload.php';

$producto = new Tienda\Producto;
$resultado = $producto-> mostrarPorId($id);

if(!$resultado)
header('Location: bebidas.php');

//si el carrito existe
if(isset($_SESSION['carrito'])){  
    //si el producto existe en el carrito
    if(array_key_exists($id,$_SESSION['carrito'])){
        actualizarProducto($id);
        //si el producto no existe en el carrito
    }else{
        agregarProducto($resultado, $id);
    }
}else{  //si el carrito no existe
    agregarProducto($resultado, $id);  
}
}
header('Location: bebidas.php');
?>

