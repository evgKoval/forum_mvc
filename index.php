<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));
require_once(ROOT . '/Autoload.php');

require_once 'db/db.php';
$db = $db->getConnection();

session_start();

$routes = [
    'login' => 'auth/login',
    'register' => 'auth/register',
    'confirm/' => 'auth/confirm/$1',
    'logout' => 'auth/logout',

    'post/create' => 'post/create',
    'post/([0-9]+)' => 'post/show/$1',
    'post/like/([0-9]+)' => 'post/likePost/$1',
    'post/dislike/([0-9]+)' => 'post/dislikePost/$1',
    'post/get-comments/([0-9]+)' => 'post/getComments/$1',
    'post/edit/([0-9]+)' => 'post/edit/$1',
    'post/delete/([0-9]+)' => 'post/delete/$1',

    'get-preferences/([0-9]+)' => 'index/getPreferences/$1',
    'preferences' => 'index/preferences',
    'search' => 'index/search',
    '' => 'index/index'
];

$uri;

if (!empty($_SERVER['REQUEST_URI'])) {
    $uri = trim($_SERVER['REQUEST_URI'], '/');
}

foreach($routes as $uriPattern => $path) {
    if (preg_match("~$uriPattern~", $uri)) {
        if(strpos($uri, '?')) {
            $uri = strstr($uri, '?', true);
        }

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