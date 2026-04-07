<?php
session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Auth.php';

Auth::check();

$db = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("SELECT username, score FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$score = $user['score'];

if ($score < 20) $level = "Beginner";
elseif ($score < 50) $level = "Intermediate";
else $level = "Advanced";

$badges = [];
if ($score >= 10) $badges[] = "SQLi Rookie";
if ($score >= 30) $badges[] = "XSS Hunter";
if ($score >= 60) $badges[] = "Cyber Warrior";

require_once __DIR__ . '/../views/header.php';
?>

<main class="container py-5">

  <section class="ix-hero ix-surface rounded-5 p-4 p-lg-5 mb-5 shadow-lg">

    <div class="row align-items-center">
      <div class="col-lg-7">

        <h1 class="display-5 fw-bold text-light mb-2">
          Welcome back, <?= htmlspecialchars($user['username']) ?>
        </h1>

        <p class="text-light-emphasis">
          SENTRIX control panel — monitor your progress, complete challenges and evolve your skills.
        </p>

        <div class="d-flex flex-wrap gap-2 mt-3">
          <span class="ix-pill">Score: <?= $score ?></span>
          <span class="ix-pill ix-pill-muted">Level: <?= $level ?></span>
        </div>

      </div>

      <div class="col-lg-5">
        <div class="ix-terminal rounded-4 p-4">

<pre class="ix-code mb-0"><code>[USER] <?= $user['username'] ?>

[SCORE] <?= $score ?>
[LEVEL] <?= $level ?>

[SYSTEM] ONLINE
[STATUS] ACTIVE
</code></pre>

        </div>
      </div>
    </div>

  </section>

  <section class="mb-5">
    <div class="row g-4">

      <div class="col-lg-4">
        <div class="ix-card ix-surface rounded-5 p-4 text-center">
          <h3 class="text-info">Score</h3>
          <div class="display-6 fw-bold"><?= $score ?></div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="ix-card ix-surface rounded-5 p-4 text-center">
          <h3 class="text-success">Level</h3>
          <div class="display-6 fw-bold"><?= $level ?></div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="ix-card ix-surface rounded-5 p-4 text-center">
          <h3 class="text-warning">Badges</h3>
          <div>
            <?php foreach ($badges as $b): ?>
              <span class="ix-tag"><?= $b ?></span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="mb-5">
    <div class="ix-surface rounded-5 p-4 shadow-lg">
      <h3 class="text-light mb-3">Progress</h3>

      <div style="background:#020617; border-radius:10px; overflow:hidden;">
        <div style="
          width: <?= min(100, $score) ?>%;
          background: linear-gradient(90deg,#22c55e,#06b6d4);
          padding: 10px;
        "></div>
      </div>
    </div>
  </section>

  <section>
    <div class="row g-4">

      <div class="col-lg-4">
        <a href="challenges.php" class="ix-link-card ix-surface rounded-5 p-4 d-block text-decoration-none">
          <h4 class="text-light">Challenges</h4>
          <p class="text-light-emphasis small">Solve labs and gain points.</p>
        </a>
      </div>

      <div class="col-lg-4">
        <a href="leaderboard.php" class="ix-link-card ix-surface rounded-5 p-4 d-block text-decoration-none">
          <h4 class="text-light">Leaderboard</h4>
          <p class="text-light-emphasis small">Compare your progress.</p>
        </a>
      </div>

      <div class="col-lg-4">
        <a href="profile.php" class="ix-link-card ix-surface rounded-5 p-4 d-block text-decoration-none">
          <h4 class="text-light">Profile</h4>
          <p class="text-light-emphasis small">Manage your account.</p>
        </a>
      </div>

    </div>
  </section>

</main>

<?php require_once __DIR__ . '/../views/footer.php'; ?>