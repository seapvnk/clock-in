<?php

class Loader
{
    public static function model($name)
    {
        require_once MODEL_PATH . "/{$name}.php";
    }
    
    public static function view($name, $params = [])
    {
        $name .= 'View';
        require_once VIEW_PATH . "/{$name}.php";
        $name::render($params);
    }
    
    public static function controller($name)
    {
        $controller = "{$name}Controller";
        require_once CONTROLLER_PATH ."/{$controller}.php";
        str_replace('/', '', $controller)();
    }
}


