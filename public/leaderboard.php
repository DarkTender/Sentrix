<?php
session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Auth.php';

Auth::check();
$db = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("SELECT username, score FROM users ORDER BY score DESC LIMIT 10");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . '/../views/header.php';
?>

<h1>Leaderboard</h1>

<?php foreach ($users as $u): ?>
  <div class="card">
    <strong><?= $u['username'] ?></strong>
    <span style="float:right; color:#22c55e;"><?= $u['score'] ?> pts</span>
  </div>
<?php endforeach; ?>

<?php require_once __DIR__ . '/../views/footer.php'; ?>