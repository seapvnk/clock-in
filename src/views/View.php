<?php

class View
{
    protected static $styles = [];
    protected static $templates = [];

    public static function render()
    {

        $currentView = get_called_class();

        $styles = $currentView::$styles;
        $templates = $currentView::$templates;
        require_once VIEW_PATH . "/templates/base.php";
    }

}