<?php require_once __DIR__ . '/../../views/header.php'; ?>
<h1>👤 Dashboard</h1>

<p>Welcome, <?= $user['username'] ?> 👋</p>

<div style="display:flex; gap:20px;">

  <div>
    <h3>XP</h3>
    <p><?= $user['xp'] ?? 0 ?></p>
  </div>

  <div>
    <h3>Rank</h3>
    <p><?= $user['rank'] ?? 'Beginner' ?></p>
  </div>

</div>

<hr>

<h2>🧩 Challenges</h2>

<?php foreach ($challenges as $c): ?>
  <div style="margin-bottom:10px;">
    <strong><?= $c['title'] ?></strong> (<?= $c['difficulty'] ?>)
    <a href="challenge.php?id=<?= $c['id'] ?>">▶ Start</a>
  </div>
<?php endforeach; ?>

<?php require_once __DIR__ . '/../../views/footer.php'; ?>