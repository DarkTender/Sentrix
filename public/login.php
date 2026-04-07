<?php
<<<<<<< Updated upstream
session_start();
=======
require_once __DIR__ . '/../views/header.php';
>>>>>>> Stashed changes

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/models/User.php';

$db = new Database();
$conn = $db->connect();

$userModel = new User($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $userModel->findByUsername($_POST['username']);

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        echo "✅ Logged in!";
    } else {
        echo "❌ Wrong credentials";
    }
}
if (isset($_SESSION['user_id'])) {
    echo "<br>Logged user ID: " . $_SESSION['user_id'];
}
?>

<<<<<<< Updated upstream
<form method="POST">
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Login</button>
</form>
=======
<div class="login-wrapper">

  <div class="login-card">

    <h1 class="login-logo">SENTRIX</h1>
    <p class="login-sub">Cybersecurity Lab Access</p>

    <?php if (!empty($error)): ?>
      <div class="login-error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="login-form">

      <div class="input-group">
        <input type="text" name="username" required>
        <label>Username</label>
      </div>

      <div class="input-group">
        <input type="password" name="password" required>
        <label>Password</label>
      </div>

      <button type="submit" class="login-btn">ACCESS SYSTEM</button>

    </form>

  </div>

</div>

<?php require_once __DIR__ . '/../views/footer.php'; ?>
>>>>>>> Stashed changes
