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

<h1 style="margin-bottom:25px;">SYSTEM DASHBOARD</h1>

<div class="grid">

  <div class="card">
    <p style="color:#94a3b8;">User</p>
    <h2><?= htmlspecialchars($user['username']) ?></h2>
  </div>

  <div class="card">
    <p style="color:#94a3b8;">Score</p>
    <h2 style="color:#22c55e;"><?= $score ?></h2>
  </div>

  <div class="card">
    <p style="color:#94a3b8;">Level</p>
    <h2 style="color:#06b6d4;"><?= $level ?></h2>
  </div>

</div>

<div class="card" style="margin-top:20px;">
  <p>Progress</p>

  <div class="progress-bar">
    <div class="progress-fill" style="width: <?= min(100, $score) ?>%"></div>
  </div>
</div>

<div class="card" style="margin-top:20px;">
  <p>Badges</p>

  <div class="badges">
    <?php foreach ($badges as $b): ?>
      <span class="badge"><?= $b ?></span>
    <?php endforeach; ?>
  </div>
</div>

<?php require_once __DIR__ . '/../views/footer.php'; ?>
echo "✅ Connected to database!";
?>

<main class="ix-container">

  <section class="ix-hero ix-card">
    <div class="ix-hero-grid">

      <div>
        <h1 class="ix-title">
          Welcome back, <?= htmlspecialchars($user['username']) ?>
        </h1>

        <p class="ix-muted">
          SENTRIX control panel — monitor your progress & evolve your skills.
        </p>

        <div class="ix-pills">
          <span class="ix-pill">Score: <?= $score ?></span>
          <span class="ix-pill ix-pill-muted">Level: <?= $level ?></span>
        </div>
      </div>

      <div class="ix-terminal">
<pre>[USER] <?= $user['username'] ?>

[SCORE] <?= $score ?>
[LEVEL] <?= $level ?>

[SYSTEM] ONLINE
[STATUS] ACTIVE</pre>
      </div>

    </div>
  </section>

  <section class="ix-grid">

    <div class="ix-card ix-center">
      <h3>Score</h3>
      <div class="ix-big"><?= $score ?></div>
    </div>

    <div class="ix-card ix-center">
      <h3>Level</h3>
      <div class="ix-big"><?= $level ?></div>
    </div>

    <div class="ix-card ix-center">
      <h3>Badges</h3>
      <div>
        <?php foreach ($badges as $b): ?>
          <span class="ix-tag"><?= $b ?></span>
        <?php endforeach; ?>
      </div>
    </div>

  </section>

  <section class="ix-card">
    <h3>Progress</h3>

    <div class="ix-progress">
      <div class="ix-progress-bar" style="width: <?= min(100, $score) ?>%;"></div>
    </div>
  </section>

  <section class="ix-grid">

    <a href="challenges.php" class="ix-link">
      <div class="ix-card">
        <h4>Challenges</h4>
      </div>
    </a>

    <a href="leaderboard.php" class="ix-link">
      <div class="ix-card">
        <h4>Leaderboard</h4>
      </div>
    </a>

    <a href="profile.php" class="ix-link">
      <div class="ix-card">
        <h4>Profile</h4>
      </div>
    </a>

  </section>

</main>

<?php require_once __DIR__ . '/../views/footer.php'; ?>