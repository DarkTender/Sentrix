<?php
session_start();
require_once '../config.php';
require_once '../app/core/Database.php';

$db = new Database();
$conn = $db->connect();

echo "✅ Connected to database!";