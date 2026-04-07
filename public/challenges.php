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

<main class="ix-container">

<h1 class="ix-title">⚡ Challenge Labs</h1>

<div class="challenge-filter">
  <button class="active" onclick="filterChallenges('all', this)">All</button>
  <button onclick="filterChallenges('easy', this)">Easy</button>
  <button onclick="filterChallenges('intermediate', this)">Intermediate</button>
  <button onclick="filterChallenges('hard', this)">Hard</button>
</div>

<div class="challenge-grid">

<?php foreach ($challenges as $c): 
  $difficulty = strtolower($c['difficulty'] ?? 'easy');
  $points = $c['points'] ?? 10;

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

    <a href="challenge.php?id=<?= $c['id'] ?>" class="challenge-btn">
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