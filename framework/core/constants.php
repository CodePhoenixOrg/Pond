<?php

namespace CodePhoenixOrg\Pond\Framework\Constants;

define('POND_DOCUMENT_ROOT', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '');

define('POND_IS_WEBAPP', !empty(POND_DOCUMENT_ROOT));
// Web environment
if (POND_IS_WEBAPP) {
    
    define('POND_SRC_DIR', realpath(POND_DOCUMENT_ROOT . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR);
    define('POND_ROOT_DIR', realpath(POND_SRC_DIR . '..') . DIRECTORY_SEPARATOR);
    define('POND_CACHE_DIR', POND_SRC_DIR . 'cache' . DIRECTORY_SEPARATOR);
    define('POND_APP_DIR', POND_SRC_DIR . 'app' . DIRECTORY_SEPARATOR);
    define('POND_APP_DATA', POND_ROOT_DIR . 'data' . DIRECTORY_SEPARATOR);
    define('POND_WEB_DIR', POND_SRC_DIR . 'web' . DIRECTORY_SEPARATOR);
    define('VIEWS_DIR', POND_APP_DIR . 'views' . DIRECTORY_SEPARATOR);

    define('POND_REQUEST_URI', $_SERVER['REQUEST_URI']);
    define('POND_REQUEST_PARAMS', $_REQUEST);
    define('POND_REQUEST_METHODS', $_SERVER['REQUEST_METHOD']);
    define('POND_QUERY_STRING', $_SERVER['QUERY_STRING']);
    define('POND_ACCEPT', $_SERVER['HTTP_ACCEPT']);
}

// CLI environment
if (!POND_IS_WEBAPP) {
    define('POND_CACHE_DIR', 'cache');
    define('POND_SRC_DIR', '.' . DIRECTORY_SEPARATOR);
    define('POND_ROOT_DIR', realpath(POND_SRC_DIR . '..') . DIRECTORY_SEPARATOR);
}

define('POND_INPUT_DIR', POND_ROOT_DIR . 'input' . DIRECTORY_SEPARATOR);
define('POND_OUTPUT_DIR', POND_ROOT_DIR . 'output' . DIRECTORY_SEPARATOR);
define('POND_CONFIG_DIR', POND_ROOT_DIR . 'config' . DIRECTORY_SEPARATOR);
define('POND_LOGS_DIR', POND_ROOT_DIR . 'logs' . DIRECTORY_SEPARATOR);

define('POND_JSON_EXTENSION', '.json');
define('POND_CSV_EXTENSION', '.csv');
