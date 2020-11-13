<?php
/**
 * registra clientes, detalles y pedidos
 */

session_start();

if($_SERVER['REQUEST_METHOD'] ==='POST'){

    require 'funciones.php';
    require 'vendor/autoload.php';

    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){

        $cliente = new Tienda\Cliente;

        $_params = array(
        'nombres' => $_POST['nombres'],
        'apellidos' => $_POST['apellidos'],
        'email' => $_POST['email'],
        'clave' => $_POST['clave'],
        'telefono' => $_POST['telefono']
        );
    
        //esta validación es para evitar que se registre el mismo correo más de una vez
        if($cliente->validarSiExisteCorreo($_POST['email'])){
            echo "<script>
                        alert('Error este correo ya se encuentra registrado');
                        window.location= 'finalizar.php'
            </script>";
        }else{
            
        $cliente_id = $cliente->registrar($_params); 
    
        $pedido = new Tienda\Pedido;
    
        $_params = array(
            'cliente_id' => $cliente_id,
            'total' => calcularTotal(),
            'fecha' => date('Y-m-d')
        );
    
        $pedido_id = $pedido -> registrar($_params);

        foreach($_SESSION['carrito'] as $indice => $value){
            $_params = array(
                "pedido_id" =>$pedido_id,
                "producto_id" =>$value['id'],
                "precio" =>$value['precio'],
                "cantidad" =>$value['cantidad']
            );
            $pedido -> registrarDetalle($_params);
        }
        $_SESSION['carrito'] = array();
        header('Location: gracias.php?id='.$pedido_id);
       
        }

        
    }else{
        print "Error al completar la compra";
    }
   
}else{
    print "Error al completar la compra";
}



