<?php

function usersController() {

    Session::validate(true);

    $exception = null;
    if (isset($_GET['delete'])) {
        try {
            User::deleteById($_GET['delete']);
            Utility::addMessage("Usuário excluido com sucesso.", 'success');
        } catch (Exception $e) {
            if (stripos($e->getMessage(), 'FOREIGN KEY')) {
                Utility::addMessage("Não é possível excluir usuário com registros de ponto.", 'error');
            } else {
                $exception = $e;
            }
        }
    }

    $users = User::all();
    foreach ($users as $user) {
        $user->start_date = (new DateTime($user->start_date))->format('d/m/Y');
        $user->end_date = $user->end_date ? (new DateTime($user->end_date))->format('d/m/Y') : '';
    }

    Loader::view('Users', [
        'users' => $users,
        'exception' => $exception,
    ]);
}
