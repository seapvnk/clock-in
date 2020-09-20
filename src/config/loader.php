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