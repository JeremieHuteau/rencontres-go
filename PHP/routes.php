<?php

// Crée le controller et appelle son action.
function route($controllerName, $action) {
    require_once($controllerName.'/'.$controllerName.'.php');

    switch($controllerName) {
        case 'home':
            $controller = new HomeController();
        break;
    }

    // Appelle la méthode adéquat du controller.
    $controller->$action();
}

// Array associatif avec le nom du controller (sans suffixe) en key
// et le nom des actions en values.
$controllerActions = array('home' => ['index', 'homes', 'home', 'error']);

// Nom de Controller invalide.
if ( !(array_key_exists($controller, $controllerActions)) ||
    // Nom d'action invalide.
    !(in_array($action, $controllerActions[$controller])) )
    route('home', 'error');
else
    route($controller, $action);

?>
