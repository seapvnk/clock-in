<?php
class Utility
{
    const DAILY_TIME = 8 * 60 ** 2;
    const HOUR = 3600;
    
    public static function redirect($location)
    {
        $url = BASE_URL . '/' . $location;
        header("Location: ${url}");
    }
}