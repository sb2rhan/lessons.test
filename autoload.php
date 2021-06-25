<?php

spl_autoload_register(function (string $name){

    $ns = [
        'App\\' => __DIR__ . '/classes',
        'Modules\\Core\\' => __DIR__ . '/modules'
    ];

    foreach ($ns as $namespace => $path){
        if(strpos($name, $namespace) !== 0)
            continue;

        $len = strlen($namespace);
        $subPath = substr($name, $len);

        $path .= "/{$subPath}.php";
        $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);

        if(file_exists($path))
            require_once $path;
    }

});