<?php

class Auth {

    public static function check() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit;
        }
    }

    public static function user() {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return null;
    }

}