<?php
require_once __DIR__ . '/../views/header.php';

session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/models/Challenge.php';

$db = new Database();
$conn = $db->connect();

$challengeModel = new Challenge($conn);
$challenges = $challengeModel->getAll();
?>

<h1>Challenges</h1>

<?php foreach ($challenges as $c): ?>
  <div class="card">
    <h3><?= $c['title'] ?></h3>
    <p style="color:#06b6d4;">[<?= $c['type'] ?>]</p>
    <a href="challenge.php?id=<?= $c['id'] ?>">Open →</a>
  </div>
<?php endforeach; ?>
<?php require_once __DIR__ . '/../views/footer.php'; ?>
