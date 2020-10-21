<?php

namespace Tienda;

class Cliente{
    
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
        $sql = "INSERT INTO `clientes`(`nombres`, `apellidos`, `email`, `clave`, `telefono`) 
        VALUES (:nombres,:apellidos,:email,:clave,:telefono)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nombres" =>$_params['nombres'],
            ":apellidos" =>$_params['apellidos'],
            ":email" =>$_params['email'],
            ":clave" =>$_params['clave'],
            ":telefono" =>$_params['telefono']   
        );

        if($resultado->execute($_array))
            return $this->cn->lastInsertId();

        return false;
    }

    public function login($correo, $clave){

        $sql="SELECT id,nombres FROM `clientes` WHERE email = :email AND clave = :clave";
        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":email" => $correo,
            ":clave" => $clave
        );

        if($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }

    public function mostrarPorId($id){ 
        $sql = "SELECT nombres,apellidos,email,clave,telefono FROM clientes
         WHERE id = :id";

        $resultado = $this->cn->prepare($sql); 

        $_array = array(
            ':id'=> $id
        );

        if($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }
}