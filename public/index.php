<?php

require_once dirname(__FILE__, 2) . '/src/config/config.php';

$uri = str_replace(BASE_ADDR, '', urldecode($_SERVER['REQUEST_URI']));

if ($uri === '/' || $uri === '' || $uri === 'index.php') {
    $uri = 'login';
}

if ($uri === 'day') {
    $uri = 'day';
}

Loader::controller($uri);

