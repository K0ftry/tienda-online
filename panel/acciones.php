<?php
require '../vendor/autoload.php';

$producto = new Tienda\Producto;

if($_SERVER['REQUEST_METHOD'] ==='POST'){

    if($_POST['accion'] ==='Registrar'){

       if(empty($_POST['nombre'])) {
        exit('Completar nombre');
       } 
       if(empty($_POST['descripcion'])) {
        exit('Completar descripcion');
       } 
       if(empty($_POST['categoria_id'])) {
        exit('Seleccionar una categoría');
       } 
       if(!is_numeric($_POST['categoria_id'])) {
        exit('Seleccionar una categoría válida');
       }  

       $_params = array(
            'nombre'=> $_POST['nombre'],
            'descripcion'=> $_POST['descripcion'],
            'foto'=> subirFoto(),
            'precio'=> $_POST['precio'],
            'categoria_id'=> $_POST['categoria_id'],
            'fecha'=> date('Y-m-d'),
            'stock'=> $_POST['stock']
       );

       $rpt = $producto->registrar($_params);

       if($rpt)
       header('Location: productos/index.php');
       else
       print 'Error al registrar producto'; 
    }
    if($_POST['accion'] ==='Actualizar'){

            if(empty($_POST['nombre'])) {
                exit('Completar nombre');
            } 
            if(empty($_POST['descripcion'])) {
             exit('Completar descripcion');
            } 
            if(empty($_POST['categoria_id'])) {
             exit('Seleccionar una categoría');
            } 
            if(!is_numeric($_POST['categoria_id'])) {
             exit('Seleccionar una categoría válida');
            }  
     
            $_params = array(
                 'nombre'=> $_POST['nombre'],
                 'descripcion'=> $_POST['descripcion'],
                 'precio'=> $_POST['precio'],
                 'categoria_id'=> $_POST['categoria_id'],
                 'fecha'=> date('Y-m-d'),
                 'stock'=> $_POST['stock'],
                 'id'=>$_POST['id']
            );

            if(!empty($_POST['foto_temp']))
            $_params['foto'] = $_POST['foto_temp'];

            if(!empty($_FILES['foto']['name']))
            $_params['foto'] = subirFoto();

            $rpt = $producto->actualizar($_params);

            if($rpt)
                header('Location: productos/index.php');
             else
                 print 'Error al actualizar producto'; 
 }
}

if($_SERVER['REQUEST_METHOD'] ==='GET'){

    $id = $_GET['id'];

    $rpt = $producto->eliminar($id);

    if($rpt)
    header('Location: productos/index.php');
    else
    print 'Error al eliminar producto'; 
}

function subirFoto(){
    $carpeta = __DIR__.'/../upload/';
    $archivo = $carpeta.$_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'],$archivo);

    return $_FILES['foto']['name'];
}

