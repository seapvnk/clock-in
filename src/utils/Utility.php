<?php
class Utility
{
    public static function redirect($location)
    {
        $url = BASE_URL . '/' . $location;
        header("Location: ${url}");
    }
}