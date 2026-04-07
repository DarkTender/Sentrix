<?php
session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Auth.php';

Auth::check();

$db = new Database();
$conn = $db->connect();

<<<<<<< Updated upstream
echo "✅ Connected to database!";
=======
$stmt = $conn->prepare("SELECT username, score FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$score = $user['score'];

// LEVEL
if ($score < 20) $level = "Beginner";
elseif ($score < 50) $level = "Intermediate";
else $level = "Advanced";

// BADGES
$badges = [];
if ($score >= 10) $badges[] = "SQLi Rookie";
if ($score >= 30) $badges[] = "XSS Hunter";
if ($score >= 60) $badges[] = "Cyber Warrior";

require_once __DIR__ . '/../views/header.php';
?>

<h1 style="margin-bottom:20px;">Dashboard</h1>

<!-- GRID -->
<div style="display:grid; grid-template-columns: repeat(3,1fr); gap:20px; margin-bottom:20px;">

  <!-- USER CARD -->
  <div class="card">
    <h3 style="color:#94a3b8;">User</h3>
    <h2><?= htmlspecialchars($user['username']) ?></h2>
  </div>

  <!-- SCORE CARD -->
  <div class="card">
    <h3 style="color:#94a3b8;">Score</h3>
    <h2 style="color:#22c55e;"><?= $score ?></h2>
  </div>

  <!-- LEVEL CARD -->
  <div class="card">
    <h3 style="color:#94a3b8;">Level</h3>
    <h2 style="color:#06b6d4;"><?= $level ?></h2>
  </div>

</div>

<!-- PROGRESS -->
<div class="card" style="margin-bottom:20px;">
  <h3 style="margin-bottom:10px;">Progress</h3>

  <div style="background:#020617; border-radius:10px; overflow:hidden;">
    <div style="
      width: <?= min(100, $score) ?>%;
      background: linear-gradient(90deg,#22c55e,#06b6d4);
      padding: 10px;
    ">
    </div>
  </div>
</div>

<!-- BADGES -->
<div class="card">
  <h3 style="margin-bottom:10px;">Badges</h3>

  <?php if (empty($badges)): ?>
    <p style="color:#94a3b8;">No badges yet</p>
  <?php else: ?>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
      <?php foreach ($badges as $b): ?>
        <span style="
          padding:6px 12px;
          border-radius:8px;
          background:linear-gradient(135deg,#06b6d4,#22c55e);
          color:black;
          font-size:14px;
        ">
          <?= $b ?>
        </span>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../views/footer.php'; ?>
>>>>>>> Stashed changes
