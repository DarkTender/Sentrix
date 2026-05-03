<?php require_once __DIR__ . '/../views/header.php';?>

<h1>👑 Admin Dashboard</h1>

<div style="display:flex; gap:20px; margin-top:20px;">

    <div style="background:#111; padding:20px; border-radius:10px;">
        <h3>📊 Users</h3>
        <p>Total users: <?php echo $totalUsers; ?></p>
    </div>

    <div style="background:#111; padding:20px; border-radius:10px;">
        <h3>🧩 Challenges</h3>
        <p>Total challenges: <?php echo $totalChallenges; ?></p>
    </div>

</div>

<hr>

<h2>🛠 Manage Challenges</h2>

<a href="admin.php?action=create" style="color:lime;">+ Add Challenge</a>

<table border="1" cellpadding="10" style="margin-top:15px;">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Type</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($challenges as $c): ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><?= $c['title'] ?></td>
        <td><?= $c['type'] ?></td>
        <td>
            <a href="admin.php?action=edit&id=<?= $c['id'] ?>">✏️ Edit</a>
            |
            <a href="admin.php?action=delete&id=<?= $c['id'] ?>" onclick="return confirm('Delete?')">❌ Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php require_once __DIR__ . '/../views/footer.php'; ?>