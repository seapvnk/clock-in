<?php

function usersController() {

    Session::validate();

    $users = User::all();
    foreach ($users as $user) {
        $user->start_date = (new DateTime($user->start_date))->format('d/m/Y');
        $user->end_date = $user->end_date ? (new DateTime($user->end_date))->format('d/m/Y') : '';
    }

    Loader::view('Users', [
        'users' => $users,
    ]);
}
