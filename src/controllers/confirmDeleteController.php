<?php

function confirmDeleteController()
{
    Session::validate(true);
    $exception = null;
    if (!isset($_GET['delete'])) {
        Utility::redirect('day');
    }

    $userToDelete = User::one(['id' => $_GET['delete']]);

    // Format date
    $startDate = DateTime::createFromFormat('Y-m-d', $userToDelete->start_date)->format('d/m/Y');
    $endDate = DateTime::createFromFormat('Y-m-d', $userToDelete->end_date)->format('d/m/Y');

    $userToDelete->start_date = $startDate;
    $userToDelete->end_date = $endDate;

    Loader::view('ConfirmDelete', [
        'userToDelete' => $userToDelete,
    ]);

}