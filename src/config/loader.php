<?php

function loadModel($name)
{
    require_once MODEL_PATH . "/{$name}.php";
}

function loadView($name, $params = [])
{
    require_once VIEW_PATH . "/{$name}.php";
    $name::render($params);
}

function loadController($name)
{
    $controller = "{$name}Controller";
    require_once CONTROLLER_PATH ."/{$controller}.php";
    call_user_func($controller);
}