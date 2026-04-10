<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/core/Database.php';

$db = new Database();
$conn = $db->connect();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
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

<?php 
  $isAdminPage = true;
  require_once __DIR__ . '/../views/header.php'; 
?>

<div class="admin-wrapper">

  <div class="sidebar">
    <h2>⚡ Sentrix</h2>
    <a href="#">Dashboard</a>
    <a href="#">Challenges</a>
    <a href="#">Users</a>
  </div>

  <div class="content">

    <div class="header-bar">
      <h1>🛠 Admin Panel</h1>
    </div>

    <?php if (!empty($success)): ?>
      <div class="success-box"><?= $success ?></div>
    <?php endif; ?>

    <div class="card">

      <form method="POST">

        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description"></textarea>

        <input type="text" name="type" placeholder="sqli / xss / crypto" required>

        <select name="difficulty">
          <option>easy</option>
          <option>intermediate</option>
          <option>hard</option>
        </select>

        <input type="number" name="points" placeholder="Points">

        <input type="text" name="answer" placeholder="Correct answer">
        <textarea name="explanation" placeholder="Explanation"></textarea>

        <button class="btn">CREATE</button>

      </form>

    </div>

  </div>

</div>

</main>

<?php require_once __DIR__ . '/../views/footer.php'; ?>