<?php
spl_autoload_register(function ($className) {
    $target = __DIR__ . "/" . str_replace('\\', '/', $className) . ".php";
    is_file($target) && is_readable($target) && require_once $target;
});