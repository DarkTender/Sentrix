<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php require_once __DIR__ . '/../../views/header.php'; ?>

<main class="challenge-container">

  <div class="challenge-box">

    <h1 class="challenge-title">🔐 Hash Cracking Lab</h1>

    <p class="challenge-desc">
      Crackni hash a zisti pôvodné heslo.
    </p>

    <div class="terminal-input" style="margin-bottom:15px;">
      <span class="prompt">hash:</span>
      <span style="color:#22c55e; font-family:monospace;">
        5f4dcc3b5aa765d61d8327deb882cf99
      </span>
    </div>

    <form method="POST" class="challenge-form">

      <div class="terminal-input">
        <span class="prompt">password:</span>
        <input type="text" name="answer" required>
      </div>

      <button type="submit" class="challenge-submit">CRACK</button>

    </form>

    <?php
    $result = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $userAnswer = trim($_POST['answer']);

        if (strtolower($userAnswer) === "password") {
            $result = "correct";
        } else {
            $result = "wrong";
        }
    }
    ?>

    <?php if ($result === "correct"): ?>
      <div class="result success">
        ✅ HASH CRACKED  
        <br><br>
        FLAG{HASH_MASTER}
      </div>
    <?php elseif ($result === "wrong"): ?>
      <div class="result error">
        ❌ WRONG PASSWORD
      </div>
    <?php endif; ?>

  </div>

</main>

<?php require_once __DIR__ . '/../../views/footer.php'; ?>