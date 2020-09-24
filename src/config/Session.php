<?php

class Session {

    public static function state()
    {
        return new Session;
    }

    public function __set($name, $value) 
    {
        $_SESSION[$name] = $value;
    }
 
    public function __get($name) 
    {
        return $_SESSION[$name]?? null;
    }

    public static function validate()
    {
        $user = $_SESSION['user']?? null;
        if (!isset($user)) {
            Utility::redirect('login');
            exit();
        }
    }

    public static function validateLogin()
    {
        $user = $_SESSION['user']?? null;
        if (isset($user)) {
            Utility::redirect('day');
            exit();
        }
    }
}