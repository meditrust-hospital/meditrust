<?php
declare(strict_types=1);

define('APP_ROOT', dirname(__DIR__));
define('PUBLIC_ROOT', dirname(APP_ROOT) . '/public');

define('APP_NAME', 'MediTrust ');

// Base URL Project works whether you run it as:
//   - http://localhost/meditrust/public
//   - http://localhost/any-folder-name/public//   

$__scriptDir = dirname($_SERVER['SCRIPT_NAME'] ?? '') ?: '';
$__scriptDir = str_replace('\\', '/', $__scriptDir);
$__scriptDir = rtrim($__scriptDir, '/');
if ($__scriptDir === '' || $__scriptDir === '/') {
    $__scriptDir = '';
}
define('BASE_URL', $__scriptDir);
unset($__scriptDir);

require_once APP_ROOT . '/config/database.php';
require_once APP_ROOT . '/core/Controller.php';
require_once APP_ROOT . '/core/Model.php';

// CSRF helpers
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function csrf_verify(?string $token): bool {
    return !empty($token) && !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
