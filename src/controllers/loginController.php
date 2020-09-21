<?php

function loginController() {
    loadModel('Login');
    $exception = null;
    
    if (count($_POST) > 0) {
        $login = new Login($_POST);

        try {
            $user = $login->checkLogin();
            echo "Usuário {$user->name} logado!";
        } catch(AppException $e) {
            $exception = $e;
        }
    }
    
    loadView('LoginView', $_POST + ['exception' => $exception]);

}