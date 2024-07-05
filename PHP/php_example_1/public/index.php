<?php

const BASE_PATH = __DIR__.'/../';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require_once base_path("{$class}.php");
});

require BASE_PATH . 'Core/functions.php';
require base_path('Core/router.php');

