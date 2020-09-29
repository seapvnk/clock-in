<?php

function saveUserController()
{
    Session::validate(true);

    Loader::model('User');
    
    if(count($_POST) === 0 && isset($_GET['update']))  {
        $user = User::one(['id' => $_GET['update']]);
        $userData = $user->getValues();
        $userData['password'] = null;
    } elseif (count($_POST) > 0) {
        try {

            $dbUser = new User($_POST);
            if($dbUser->id) {
                $dbUser->update();
                Utility::addMessage(
                    'Usuário atualizado com sucesso!',
                    'success'
                ); 
                Utility::redirect('users');
                exit();
            } else {
                $dbUser->insert();
                Utility::addMessage(
                    'Usuário cadastrado com sucesso!',
                    'success'
                );  
            }
            $_POST = [];
            
        } catch (Exception $e) {
            $exception = $e;
        } finally {
            $userData = $_POST;
        }
    }

    if (isset($exception) && get_class($exception) == 'ValidationException') {
        $errors = $exception->getErrors();
    } else {
        $errors = [];
    }

    Loader::view('SaveUser', $_POST + [
        'exception' => $exception?? null,
        'errors' => $errors,
    ]);
}