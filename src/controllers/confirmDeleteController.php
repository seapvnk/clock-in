<?php

function confirmDeleteController()
{
    Session::validate(true);
    $exception = null;
    if (!isset($_GET['delete'])) {
        Utility::redirect('day');
    }

    $userToDelete = User::one(['id' => $_GET['delete']]);
    
    Loader::view('ConfirmDelete', [
        'userToDelete' => $userToDelete,
    ]);

}