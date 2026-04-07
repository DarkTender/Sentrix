<?php
require_once __DIR__ . '/../views/header.php';

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
=======
echo "✅ Connected to database!";
?>
<?php require_once __DIR__ . '/../views/footer.php'; ?>
