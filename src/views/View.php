<?php

class View
{
    protected static $styles = [];
    protected static $templates = [];

    public static function render($params = [])
    {

        $currentView = get_called_class();

        $styles = $currentView::$styles;
        $templates = $currentView::$templates;

        // initialize variables used in templates
        if (count($params) > 0) {
            foreach ($params as  $variableName => $value) {
                if (strlen($variableName) > 0) {
                    ${$variableName} = $value;
                }
            }
        }

        require_once TEMPLATE_PATH . "/base.php";
    }

    public static function renderMessage()
    {
        require_once TEMPLATE_PATH . "/messages.php";
    }

}