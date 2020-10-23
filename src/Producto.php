<?php

namespace Tienda;

class Producto{
    
    private $config;
    private $cn = null;

    public function __construct(){

        $this->config = parse_ini_file(__DIR__.'/../config.ini');

        $this->cn =new \PDO($this->config['dns'], $this->config['usuario'], $this->config
        ['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
    }

    public function registrar($_params){
        $sql = "INSERT INTO `productos`(`nombre`, `descripcion`, `foto`, `precio`, `categoria_id`, `fecha`, `stock`) VALUES (:nombre,:descripcion,:foto,:precio,:categoria_id,:fecha,:stock)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nombre" =>$_params['nombre'],
            ":descripcion" =>$_params['descripcion'],
            ":foto" =>$_params['foto'],
            ":precio" =>$_params['precio'],
            ":categoria_id" =>$_params['categoria_id'],
            ":fecha" =>$_params['fecha'],
            ":stock" =>$_params['stock']

        );

        if($resultado->execute($_array))
            return true;

        return false;
    }
    public function actualizar($_params){

        $sql = "UPDATE `productos` SET `nombre`=:nombre,`descripcion`=:descripcion,`foto`=:foto,`precio`=:precio,`categoria_id`=:categoria_id,`fecha`=:fecha,`stock`=:stock WHERE `id`=:id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nombre" =>$_params['nombre'],
            ":descripcion" =>$_params['descripcion'],
            ":foto" =>$_params['foto'],
            ":precio" =>$_params['precio'],
            ":categoria_id" =>$_params['categoria_id'],
            ":fecha" =>$_params['fecha'],
            ":stock" =>$_params['stock'],
            ":id" => $_params['id']

        );
        

        if($resultado->execute($_array))
            return true;

        return false;
    }

    public function descontarStock($id,$cantidad){
        $producto = $this->mostrarPorId($id);

        $resta = $producto['stock'] - $cantidad;

        $sql = "UPDATE `productos` SET `stock`=:stock WHERE `id`=:id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":stock" =>$resta,
            ":id" => $id
        );
        
        if($resultado->execute($_array))
            return true;

        return false;
    }

    public function eliminar($id){

        $sql="DELETE FROM productos WHERE id=:id";
        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":id" => $id
        );

        if($resultado->execute($_array))
            return true;

        return false;
    }
    public function mostrar(){

        $sql="SELECT productos.id, nombre, descripcion, foto, categoria_nombre, precio, fecha, estado, stock FROM productos
        
        INNER JOIN categorias
        ON productos.categoria_id = categorias.id ORDER BY productos.id DESC
        ";
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }

    public function buscarProducto($nombre){

        $sql="SELECT productos.id, nombre, descripcion, foto, categoria_nombre, precio, fecha, estado, stock FROM productos 
        
        INNER JOIN categorias
        ON productos.categoria_id = categorias.id WHERE nombre like '%' :nombre '%'
        ";
        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ':nombre'=> $nombre
        );

        if($resultado->execute($_array))
            return $resultado->fetchAll();

        return false;
    }

    public function mostrarDespensa(){

        $sql="SELECT productos.id, nombre, descripcion, foto, categoria_nombre, precio, fecha, estado, stock FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id WHERE categorias.categoria_nombre = 'DESPENSA' ORDER BY productos.id DESC
        ";
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }

    public function mostrarSnacks(){

        $sql="SELECT productos.id, nombre, descripcion, foto, categoria_nombre, precio, fecha, estado, stock FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id WHERE categorias.categoria_nombre = 'SNACKS' ORDER BY productos.id DESC
        ";
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }

    public function mostrarBebidas(){

        $sql="SELECT productos.id, nombre, descripcion, foto, categoria_nombre, precio, fecha, estado, stock FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id WHERE categorias.categoria_nombre = 'BEBIDAS, JUGOS Y AGUAS' ORDER BY productos.id DESC
        ";
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }

    public function mostrarVinos(){

        $sql="SELECT productos.id, nombre, descripcion, foto, categoria_nombre, precio, fecha, estado, stock FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id WHERE categorias.categoria_nombre = 'VINOS Y LICORES' ORDER BY productos.id DESC
        ";
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }

    public function mostrarLacteos(){

        $sql="SELECT productos.id, nombre, descripcion, foto, categoria_nombre, precio, fecha, estado, stock FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id WHERE categorias.categoria_nombre = 'LÁCTEOS' ORDER BY productos.id DESC
        ";
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }

    public function mostrarCongelados(){

        $sql="SELECT productos.id, nombre, descripcion, foto, categoria_nombre, precio, fecha, estado, stock FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id WHERE categorias.categoria_nombre = 'CONGELADOS' ORDER BY productos.id DESC
        ";
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }

    public function mostrarAseo(){

        $sql="SELECT productos.id, nombre, descripcion, foto, categoria_nombre, precio, fecha, estado, stock FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id WHERE categorias.categoria_nombre = 'ASEO Y LIMPIEZA' ORDER BY productos.id DESC
        ";
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }

    public function mostrarPorId($id){

        $sql="SELECT * FROM productos WHERE id =:id";
        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":id" => $id 
        );

        if($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }
}