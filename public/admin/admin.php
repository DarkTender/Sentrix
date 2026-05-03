<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../app/core/Database.php';

$db = new Database();
$conn = $db->connect();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user']['id']]);
$user = $stmt->fetch();

if ($user['role'] !== 'admin') {
    die("Access denied");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $conn->prepare("
        INSERT INTO challenges 
        (title, description, type, difficulty, points, correct_answer, explanation)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $_POST['title'],
        $_POST['description'],
        $_POST['type'],
        $_POST['difficulty'],
        $_POST['points'],
        $_POST['answer'],
        $_POST['explanation']
    ]);

    $success = "Challenge created!";
}
?>

<link rel="stylesheet" href="/Sentrix/css/admin_challenges.css">

<?php 
  $isAdminPage = true;
  require_once __DIR__ . '/../../views/header.php'; 
?>

<div class="admin-wrapper">

    <?php require_once __DIR__ . '/../../views/admin_sidebar.php'; ?>

  <div class="content">

    <div class="header-bar">
      <h1>🛠 Admin Panel</h1>
    </div>

    <?php if (!empty($success)): ?>
      <div class="success-box"><?= $success ?></div>
    <?php endif; ?>

    <div class="card">

      <form method="POST">

        <div>
          <div class="label">Title</div>
          <input type="text" name="title" placeholder="SQL Injection Login" required>
        </div>

        <div>
          <div class="label">Type</div>
          <input type="text" name="type" placeholder="sqli / xss / crypto" required>
        </div>

        <div style="grid-column:1/-1;">
          <div class="label">Description</div>
          <textarea name="description" placeholder="Describe the challenge..."></textarea>
        </div>

        <div>
          <div class="label">Difficulty</div>
          <select name="difficulty">
            <option>easy</option>
            <option>intermediate</option>
            <option>hard</option>
          </select>
        </div>

        <div>
          <div class="label">Points</div>
          <input type="number" name="points" placeholder="10">
        </div>

        <div>
          <div class="label">Correct Answer</div>
          <input type="text" name="answer" placeholder="flag{...}">
        </div>

        <div>
          <div class="label">Explanation</div>
          <textarea name="explanation" placeholder="Explain solution..."></textarea>
        </div>

        <button class="btn">🚀 Create Challenge</button>

      </form>

    </div>

  </div>

</div>

</main>

<?php require_once __DIR__ . '/../../views/footer.php'; ?>