<?php
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
  <div>
    <h3><?= $c['title'] ?></h3>
    <p>Type: <?= $c['type'] ?></p>
    <a href="challenge.php?id=<?= $c['id'] ?>">Open</a>
  </div>
<?php endforeach; ?>