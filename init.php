<?php
// init.php
define('APP_START', microtime(true));
$env = 'development';
$envFile = __DIR__ . '/.env';
if (is_file($envFile) && is_readable($envFile)) {
    $vars = @parse_ini_file($envFile, false, INI_SCANNER_TYPED) ?: [];
    if (!empty($vars['APP_ENV'])) $env = (string)$vars['APP_ENV'];
}
define('APP_ENV', $env);

if (APP_ENV === 'production') {
    ini_set('display_errors', '0'); ini_set('log_errors', '1'); error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
} else {
    ini_set('display_errors', '1'); ini_set('log_errors', '1'); error_reporting(E_ALL);
}

ini_set('default_charset', 'UTF-8'); if (function_exists('mb_internal_encoding')) mb_internal_encoding('UTF-8');
date_default_timezone_set('Europe/Warsaw');

define('BASE_PATH', __DIR__);
define('CONFIG_PATH', BASE_PATH . '/config');
define('INCLUDES_PATH', BASE_PATH . '/includes');
define('AJAX_PATH', BASE_PATH . '/ajax');
define('UPLOADS_PATH', BASE_PATH . '/uploads');
define('COVERS_PATH', UPLOADS_PATH . '/covers');

if (!is_dir(UPLOADS_PATH)) @mkdir(UPLOADS_PATH, 0755, true);
if (!is_dir(COVERS_PATH)) @mkdir(COVERS_PATH, 0755, true);

$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ((int)($_SERVER['SERVER_PORT'] ?? 0) === 443);
$cookie = ['lifetime'=>0,'path'=>'/','domain'=>'','secure'=>$isHttps,'httponly'=>true,'samesite'=>'Lax'];
if (PHP_VERSION_ID >= 70300) { session_set_cookie_params($cookie); } else {
    session_set_cookie_params($cookie['lifetime'], $cookie['path'].'; samesite='.$cookie['samesite'], $cookie['domain'], $cookie['secure'], $cookie['httponly']);
}

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Referrer-Policy: no-referrer-when-downgrade');

require_once CONFIG_PATH . '/database.php';
require_once INCLUDES_PATH . '/functions.php';
require_once INCLUDES_PATH . '/auth.php';

if (!isset($_SESSION['csrf_token']) && function_exists('generateCSRFToken')) { generateCSRFToken(); }

function app_uptime_ms(): int { return (int) round((microtime(true) - APP_START) * 1000); }
