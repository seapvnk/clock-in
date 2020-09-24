<?php

function loginController() {
    Loader::model('Login');
    Session::validateLogin();
    $exception = null;
    
    if (count($_POST) > 0) {
        $login = new Login($_POST);

        try {
            $user = $login->checkLogin();
            Session::state()->user = serialize($user);
            Utility::redirect('day');
        } catch(AppException $e) {
            $exception = $e;
        }
    }
    
    Loader::view('LoginView', $_POST + ['exception' => $exception]);

}
