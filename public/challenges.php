<?php
session_start();
require_once __DIR__ . '/../views/header.php';


require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/models/Challenge.php';
require_once __DIR__ . '/../app/core/Auth.php';

Auth::check();
$db = new Database();
$conn = $db->connect();

$challengeModel = new Challenge($conn);

$difficulty = $_GET['difficulty'] ?? 'all';

if ($difficulty === 'all') {
    $challenges = $challengeModel->getAll();
} else {
    $challenges = $challengeModel->getByDifficulty($difficulty);
}
?>

<main class="ix-container">

<h1 class="ix-title">⚡ Challenge Labs</h1>

<div class="challenge-filter">
  <a href="?difficulty=all" class="filter-btn <?= $difficulty=='all'?'active':'' ?>">All</a>
  <a href="?difficulty=easy" class="filter-btn <?= $difficulty=='easy'?'active':'' ?>">Easy</a>
  <a href="?difficulty=intermediate" class="filter-btn <?= $difficulty=='intermediate'?'active':'' ?>">Intermediate</a>
  <a href="?difficulty=hard" class="filter-btn <?= $difficulty=='hard'?'active':'' ?>">Hard</a>
  <a href="?difficulty=extreme" class="filter-btn <?= $difficulty=='extreme'?'active':'' ?>">Extreme</a>

</div>

<div class="challenge-grid">

<?php foreach ($challenges as $c): 
  $cardDifficulty = strtolower($c['difficulty'] ?? 'easy');
  $points = $c['points'] ?? 10;
  $status = rand(0,1) ? "solved" : "new";
?>

  <div class="challenge-card <?= $status ?>">

    <div class="challenge-header">
      <h3><?= htmlspecialchars($c['title']) ?></h3>
      <span class="badge <?= $cardDifficulty ?>">
        <?= ucfirst($cardDifficulty) ?>
      </span>
    </div>

    <div class="challenge-meta">
      <span class="type"><?= strtoupper($c['type']) ?></span>
      <span class="points">+<?= $points ?> XP</span>
    </div>

    <div class="challenge-status <?= $status ?>">
      <?= $status === 'solved' ? '✔ Solved' : '⚡ New' ?>
    </div>

    <a href="/Sentrix/public/challenge.php?id=<?= $c['id'] ?>" class="challenge-btn">
      Enter Lab →
    </a>

  </div>

<?php endforeach; ?>

</div>

</main>

<?php require_once __DIR__ . '/../views/footer.php'; ?>