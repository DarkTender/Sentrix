<?php
require_once __DIR__ . '/../views/header.php';

session_start();

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

<form method="POST">
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Login</button>
</form>
<?php require_once __DIR__ . '/../views/footer.php'; ?>
