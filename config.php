<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
define('DB_HOST', 'localhost');
define('DB_NAME', 'sentrix');
define('DB_USER', 'root');
define('DB_PASS', '');
?>