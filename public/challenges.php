<?php
require_once __DIR__ . '/../views/header.php';

session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/models/Challenge.php';

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

</div>

<div class="challenge-grid">

<?php foreach ($challenges as $c): 
  $cardDifficulty = strtolower($c['difficulty'] ?? 'easy');  $points = $c['points'] ?? 10;
  $status = rand(0,1) ? "solved" : "new";
?>

  <div class="challenge-card <?= $status ?>" data-difficulty="<?= $difficulty ?>">

    <div class="challenge-header">
      <h3><?= $c['title'] ?></h3>
      <span class="badge <?= $difficulty ?>"><?= ucfirst($difficulty) ?></span>
    </div>

    <div class="challenge-meta">
      <span class="type"><?= strtoupper($c['type']) ?></span>
      <span class="points">+<?= $points ?> XP</span>
    </div>

    <div class="challenge-status <?= $status ?>">
      <?= $status === 'solved' ? '✔ Solved' : '⚡ New' ?>
    </div>

    <a href="quest/challenge.php?id=<?= $c['id'] ?>" class="challenge-btn">
      Enter Lab →
    </a>

  </div>

<?php endforeach; ?>

</div>

</main>

<script>
function filterChallenges(level, btn) {

  document.querySelectorAll('.challenge-card').forEach(card => {
    if (level === 'all' || card.dataset.difficulty === level) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });

  document.querySelectorAll('.challenge-filter button').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
}
</script>

<?php require_once __DIR__ . '/../views/footer.php'; ?>