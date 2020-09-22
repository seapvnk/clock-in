<?php

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

// APP
define('APP_NAME', 'Clock-in!');
define('BASE_URL', 'http://localhost/clock-in/public');
define('BASE_ADDR', '/clock-in/public');

// Directories
define('MODEL_PATH', realpath(dirname(__FILE__) . '/../models'));
define('VIEW_PATH', realpath(dirname(__FILE__) . '/../views'));
define('TEMPLATE_PATH', realpath(dirname(__FILE__) . '/../views/templates'));
define('EXCEPTION_PATH', realpath(dirname(__FILE__) . '/../exceptions'));
define('CONTROLLER_PATH', realpath(dirname(__FILE__) . '/../controllers'));
define('UTIL_PATH', realpath(dirname(__FILE__) . '/../utils/Utility.php'));


// Classes
require_once realpath(dirname(__FILE__) . '/Database.php');
require_once realpath(dirname(__FILE__) . '/Loader.php');

require_once realpath(MODEL_PATH . '/Model.php');
require_once realpath(VIEW_PATH . '/View.php');

// Exception classes
require_once realpath(EXCEPTION_PATH . '/AppException.php');
require_once realpath(EXCEPTION_PATH . '/ValidationException.php');

// Utility
require_once realpath(UTIL_PATH);
