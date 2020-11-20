<?php 
require __DIR__ . "/Source/Support/config.php";
require __DIR__ . "/Source/Support/helpers.php";
session_start();

spl_autoload_register(function ($class) {
    require_once (str_replace('\\', '/', $class . '.php'));
});

$controller = new Source\Core\Route();

$controller->run();
