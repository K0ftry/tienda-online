<?php

/**
 * agregarProducto
 *
 * agrega productos a la sesión de carrito
 * @param  $resultado
 * @param  $id
 * @param  $cantidad
 * @return void
 */
function agregarProducto($resultado, $id, $cantidad = 1){
    $_SESSION['carrito'][$id] = array(

        'id' => $resultado['id'],
        'nombre' => $resultado['nombre'],
        'foto' => $resultado['foto'],
        'precio' => $resultado['precio'],
        'cantidad' => $cantidad
    );  
}

/**
 * actualizarProducto
 *
 * actualiza cantidad de productos en carrito
 * @param  $id
 * @param  $cantidad
 * @return void
 */
function actualizarProducto($id,$cantidad = FALSE){

    if($cantidad){
        $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
    }else{
        $_SESSION['carrito'][$id]['cantidad'] += 1;
    }
    
}

/**
 * calcularTotal
 *
 * calcula costo total de productos
 * @return integer
 */
function calcularTotal(){
    $total = 0;
    if(isset($_SESSION['carrito'])){
        foreach($_SESSION['carrito'] as $indice => $value){
            $total += $value['precio'] * $value['cantidad'];
        }
    }
    return $total;
}

/**
 * cantidadProductos
 *
 * @return void
 */
function cantidadProductos(){
    $cantidad = 0;
    if(isset($_SESSION['carrito'])){
        foreach($_SESSION['carrito'] as $indice => $value){
            $cantidad++;
        }
    }
    return $cantidad;
}