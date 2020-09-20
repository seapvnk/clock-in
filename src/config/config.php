<?php

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

// Directories
define('APP_NAME', 'Clock-in!');
define('MODEL_PATH', realpath(dirname(__FILE__) . '/../models'));
define('VIEW_PATH', realpath(dirname(__FILE__) . '/../views'));


// Classes
require_once realpath(dirname(__FILE__) . '/Database.php');
require_once realpath(MODEL_PATH . '/Model.php');
require_once realpath(VIEW_PATH . '/View.php');
