<?php
/**
 * Cierra la sesión de los clientes
 */
session_start();
$_SESSION['cliente_info'] = array();
header('Location: ../index.php?pagina=1');