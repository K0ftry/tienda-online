<?php
/**
 * cierra la sesión de usuario
 */
session_start();
$_SESSION['usuario_info'] = array();
header('Location: index.php');