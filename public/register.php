<?php
require_once __DIR__ . '/../views/header.php';

require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../config.php';

$db = new Database();
$conn = $db->connect();

$userModel = new User($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userModel->create($_POST['username'], $_POST['password']);
    echo "✅ User created!";
}
?>
<form method="POST">
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Register</button>
</form>
<?php require_once __DIR__ . '/../views/footer.php'; ?>
