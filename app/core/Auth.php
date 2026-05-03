<?php

class Auth {

    public static function check() {
        if (!isset($_SESSION['user'])) {
            header("Location: login.php");
            exit;
        }
    }

    public static function user() {
        return $_SESSION['user'] ?? null;
    }
}
?>