<?php

class AppView extends View
{
    protected static $styles = [];
    protected static $templates = [];

    public static function render($params = [])
    {
        parent::render($params + ['user' => unserialize(Session::state()->user)]);
    }


    public static function renderTitle($title, $subtitle, $icon)
    {
        include TEMPLATE_PATH . '/title.php';
    }

}