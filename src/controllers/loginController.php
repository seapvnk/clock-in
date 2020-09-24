<?php

function loginController() {
    session_start();
    Session::validateLogin();
    Loader::model('Login');
    $exception = null;
    
    if (count($_POST) > 0) {
        $login = new Login($_POST);

        try {
            $user = $login->checkLogin();
            $_SESSION['user'] = $user;
            Utility::redirect('day');
        } catch(AppException $e) {
            $exception = $e;
        }
    }
    
    Loader::view('LoginView', $_POST + ['exception' => $exception]);

}
