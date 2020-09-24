<?php

require_once dirname(__FILE__, 2) . '/src/config/config.php';

$uri = str_replace(BASE_ADDR, '', urldecode($_SERVER['REQUEST_URI']));
$uri = parse_url($uri, PHP_URL_PATH);

if ($uri === '/' || $uri === '') {
    $uri = 'day';
}

if ($uri === 'day') {
    $uri = 'day';
}

if ($uri === 'login') {
    $uri = 'login';
}

Loader::controller($uri);

