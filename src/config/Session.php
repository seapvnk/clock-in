<?php

class Session {
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