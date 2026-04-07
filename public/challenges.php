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

<h1 class="ix-title">Challenges</h1>

<!-- FILTER -->
<div class="challenge-filter">
  <button onclick="filterChallenges('all')">All</button>
  <button onclick="filterChallenges('easy')">Easy</button>
  <button onclick="filterChallenges('intermediate')">Intermediate</button>
  <button onclick="filterChallenges('hard')">Hard</button>
</div>

<!-- GRID -->
<div class="challenge-grid">

<?php foreach ($challenges as $c): 
  $difficulty = strtolower($c['difficulty'] ?? 'easy');
?>
  <div class="challenge-card" data-difficulty="<?= $difficulty ?>">

    <div class="challenge-header">
      <h3><?= $c['title'] ?></h3>
      <span class="badge <?= $difficulty ?>"><?= ucfirst($difficulty) ?></span>
    </div>

    <p class="challenge-type">[<?= $c['type'] ?>]</p>

    <a href="challenge.php?id=<?= $c['id'] ?>" class="challenge-btn">
      Start →
    </a>

  </div>
<?php endforeach; ?>

</div>

</main>

<script>
function filterChallenges(level) {
  document.querySelectorAll('.challenge-card').forEach(card => {
    if (level === 'all' || card.dataset.difficulty === level) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
}
</script>

<?php require_once __DIR__ . '/../views/footer.php'; ?>