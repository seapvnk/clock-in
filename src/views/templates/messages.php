<?php

$errors = [];
$message = null;
$exception = $exception?? null;


if ($exception) {
    $message = [
        'type' => 'error',
        'message' => $exception->getMessage(),
    ];

    if (get_class($exception) === 'ValidationException') {
        $errors = $exception->getErrors();  
    }
}




$alertType = 'info';
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