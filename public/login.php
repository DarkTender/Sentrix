<?php
require_once __DIR__ . '/../views/header.php';


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
        header("Location: index.php");
        exit;
    } else {
        $error = "Wrong credentials";
    }
}
?>


<link rel="stylesheet" href="../css/style.css">

<div style="height:100vh; display:flex; justify-content:center; align-items:center;">

  <div class="card" style="width:350px; text-align:center;">

    <h2 style="margin-bottom:20px;">SENTRIX LAB</h2>

    <?php if (!empty($error)): ?>
      <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <button type="submit">Login</button>
    </form>

  </div>

</div>
<?php require_once __DIR__ . '/../views/footer.php'; ?>
