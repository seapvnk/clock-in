<?php

Loader::model('WorkingHours');

function clockinController()
{
    Session::validate();
    
    $user = unserialize(Session::state()->user);
    $records = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));

    try {
        $currentTime = strftime("%H:%M:%S", time());

        if ($_POST['forcedTime']) {
            $currentTime = $_POST['forcedTime'];
        }

        $records->clockin($currentTime);
        Utility::addMessage('Ponto inserido com sucesso', 'success');

    } catch (AppException $e) {

        Utility::addMessage($e->getMessage(), 'error');
    
    }

    Utility::redirect('day');

}