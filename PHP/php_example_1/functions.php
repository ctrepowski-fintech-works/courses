<?php

function dd($variable){
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';

    die();
}

function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}

function authorize($condition, $status = Response::FORBIDDEN) {
    if (!$condition) {
        abort($status);
    }
}

function base_path($path) {
    return BASE_PATH . $path;
}

function view($path, $params = [])
{
    extract($params);
    require base_path("views/{$path}");
}