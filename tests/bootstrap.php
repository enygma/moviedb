<?php

// custom autoloader...simple really :)
spl_autoload_register(function($className) {
    $classPath = __DIR__.'/../lib/'.str_replace('\\', '/', $className).'.php';
    if (is_file($classPath)) {
        require_once $classPath;
    }
});

?>
