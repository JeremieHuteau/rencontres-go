<?php
// Pour ne pas avoir à le faire partout après
require_once 'db.php';

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    // Page par défaut
    $controller = 'home';
    $action = 'index';
}

// Layout de base.
require_once('layouts/base.php');


?>
