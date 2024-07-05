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