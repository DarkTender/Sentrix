<?php

session_start();

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../app/core/Database.php';
require_once __DIR__ . '/../../app/models/Challenge.php';

$db = new Database();
$conn = $db->connect();

$challengeModel = new Challenge($conn);

$id = $_GET['id'];

$challengeModel->delete($id);

header("Location: admin.php");
exit;