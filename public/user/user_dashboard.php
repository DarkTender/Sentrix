<?php require_once __DIR__ . '/../../views/header.php'; ?>

<style>
body {
    background: #0f172a;
    color: #e2e8f0;
    font-family: 'Segoe UI', sans-serif;
}

.container {
    max-width: 1100px;
    margin: auto;
    padding: 20px;
}

.card {
    background: #1e293b;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 0 20px rgba(0,0,0,0.3);
}

.flex {
    display: flex;
    gap: 20px;
}

.stat {
    flex: 1;
    text-align: center;
    background: #020617;
    border-radius: 10px;
    padding: 15px;
}

.stat h3 {
    margin: 0;
    color: #38bdf8;
}

.stat p {
    font-size: 24px;
    margin: 5px 0 0;
}

.challenge {
    background: #020617;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.challenge strong {
    color: #facc15;
}

.btn {
    background: #38bdf8;
    color: black;
    padding: 5px 10px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
}

.btn:hover {
    background: #0ea5e9;
}
</style>

<div class="container">

    <div class="card">
        <h1>👤 Dashboard</h1>
        <p>Welcome back, <strong><?= htmlspecialchars($user['username']) ?></strong> 👋</p>

        <div class="flex">
            <div class="stat">
                <h3>XP</h3>
                <p><?= $user['xp'] ?? 0 ?></p>
            </div>

            <div class="stat">
                <h3>Rank</h3>
                <p><?= $user['rank'] ?? 'Beginner' ?></p>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <h2>🧩 Challenges</h2>

        <?php if (!empty($challenges)): ?>
            <?php foreach ($challenges as $c): ?>
                <div class="challenge">
                    <div>
                        <strong><?= htmlspecialchars($c['title']) ?></strong>
                        <span>(<?= htmlspecialchars($c['difficulty']) ?>)</span>
                    </div>
                    <a class="btn" href="../challenge.php?id=<?= $c['id'] ?>">Start</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No challenges available.</p>
        <?php endif; ?>

    </div>

</div>

<?php require_once __DIR__ . '/../../views/footer.php'; ?>