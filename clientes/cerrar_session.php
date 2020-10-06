<?php
session_start();
$_SESSION['cliente_info'] = array();
header('Location: ../index.php');