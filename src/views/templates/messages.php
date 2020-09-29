<?php

$message = null;
$errors = [];

$exception = $exception?? null;

if (unserialize(Session::state()->message)) {
    $message = unserialize(Session::state()->message);
    Session::stateRemove('message');
}


if ($exception) {
    $message = [
        'type' => 'error',
        'message' => $exception->getMessage(),
    ];

    if (get_class($exception) === 'ValidationException') {
        $errors = $exception->getErrors();  
    }
}


$alertType = 'success';
if ($message && $message['type'] === 'error') {
    $alertType = 'danger';
}

?>
<?php if ($message): ?>
    <div
        class="alert alert-<?= $alertType ?>" 
        role="alert"
    >
        <?= $message['message'] ?>
    </div>
<?php endif; ?>