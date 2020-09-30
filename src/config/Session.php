<?php

class Session {

    public static function state()
    {
        return new Session;
    }

    public static function stateRemove($state)
    {
        self::state()->$state = null;
    }

    public function __set($name, $value) 
    {
        $_SESSION[$name] = $value;
    }
 
    public function __get($name) 
    {
        return $_SESSION[$name]?? null;
    }

    public static function validate($requireAdmin = false)
    {
        $user = unserialize(Session::state()->user)?? null;

        if (!isset($user)) {
            Utility::redirect('login');
            exit();
        } elseif ($requireAdmin && !$user->is_admin) {
            Utility::addMessage('Acesso negado', 'error');
            Utility::redirect('day');
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