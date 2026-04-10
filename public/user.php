<?php
session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/core/Database.php';

$db = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("SELECT username, score FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<?php require_once __DIR__ . '/../views/header.php'; ?>

<main class="ix-container">

<h1 class="ix-title">👤 User Panel</h1>

<div class="ix-card">
  <h2><?= htmlspecialchars($user['username']) ?></h2>
  <p>Score: <?= $user['score'] ?></p>
</div>

</main>

<?php require_once __DIR__ . '/../views/footer.php'; ?>