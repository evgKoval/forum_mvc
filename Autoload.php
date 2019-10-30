<?php

spl_autoload_register('autoload');

function autoload($class_name) {
    $array_paths = [
        '/models/',
        '/phpmailer/'
    ];

    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}