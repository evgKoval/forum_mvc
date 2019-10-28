<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

session_start();

$routes = [
    'login' => 'auth/login',
    'register' => 'auth/register',
    'confirm/' => 'auth/confirm/$1'
    //'' => 'site/index'
];

$uri;

if (!empty($_SERVER['REQUEST_URI'])) {
    $uri = trim($_SERVER['REQUEST_URI'], '/');
}

foreach($routes as $uriPattern => $path) {
    if (preg_match("~$uriPattern~", $uri)) {
        $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

        $segments = explode('/', $internalRoute);

        $controllerName = array_shift($segments) . 'Controller';
        $controllerName = ucfirst($controllerName);
        
        $actionName = 'action' . ucfirst(array_shift($segments));

        $parameters = $segments;

        $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
        if(file_exists($controllerFile)) {
            include_once($controllerFile);
        }

        $controllerObject = new $controllerName;

        $result = call_user_func_array([$controllerObject, $actionName], $parameters);

        if($result != NULL) {
            break;
        }
    }
}