<?php

const BASE_PATH = __DIR__.'/../';

spl_autoload_register(function ($class) {
    require_once base_path("Core/{$class}.php");
});

require BASE_PATH . 'functions.php';
require base_path('router.php');

