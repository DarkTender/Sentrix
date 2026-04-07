<?php
session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/models/Challenge.php';

$db = new Database();
$conn = $db->connect();

$challengeModel = new Challenge($conn);

$id = $_GET['id'] ?? null;
$challenge = $challengeModel->getById($id);

if (!$challenge) {
    echo "Challenge not found";
    exit;
}
?>

<h1><?= $challenge['title'] ?></h1>
<p><?= $challenge['description'] ?></p>

<form method="POST">
  <input type="text" name="answer" placeholder="Your payload">
  <button type="submit">Submit</button>
</form>
