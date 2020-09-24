<?php

class DayView extends View
{
    protected static $styles = [];
    protected static $templates = ['header', 'left', 'day', 'footer'];

    public static function render($params = [])
    {
        parent::render($params + ['user' => unserialize(Session::state()->user)]);
    }

}


