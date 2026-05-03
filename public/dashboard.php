<?php
session_start();

require_once '../app/core/Auth.php';

Auth::check();

$user = $_SESSION['user']; 

if (!$user) {
    header("Location: login.php");
    exit;
}

if ($user['role'] === 'admin') {
    header("Location: admin/admin.php"); 
    exit;
} else {
    include '/user/user_dashboard.php';
}