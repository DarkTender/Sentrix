<?php require_once __DIR__ . '/../../views/header.php'; ?>
<?php 
if (isset($_GET['source'])) {
    highlight_file(__FILE__);
}
if (isset($_GET['source'])) {
    $file = "challenges/challenge" . $_GET['id'] . ".php";

    if (file_exists($file)) {
        highlight_file($file);
        exit;
    }
}
?>
<main class="challenge-container">

  <div class="challenge-box">

    <h1 class="challenge-title">🕵️ Hidden Source Lab</h1>

    <p class="challenge-desc">
      Pozri source stránky a nájdi skryté heslo.
    </p>

    <div class="terminal-input" style="margin-bottom:15px;">
      <span class="prompt">system:</span>
      <span>Welcome to secure panel...</span>
    </div>

    <!-- dev_note: try ?debug -->
    <form method="POST" class="challenge-form">

      <div class="terminal-input">
        <span class="prompt">password:</span>
        <input type="text" name="answer" placeholder="Enter password..." required>
      </div>

      <button type="submit" class="challenge-submit">LOGIN</button>

    </form>

    <?php
    $result = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $userAnswer = trim($_POST['answer']);

        if ($userAnswer === "WerZ23...12poREtzuF") {
            $result = "correct";
        } else {
            $result = "wrong";
        }
    }
    ?>

    <?php if ($result === "correct"): ?>
      <div class="result success">
        ✅ ACCESS GRANTED  
        <br><br>
        FLAG{SOURCE_MASTER}
      </div>
    <?php elseif ($result === "wrong"): ?>
      <div class="result error">
        ❌ ACCESS DENIED"
      </div>
    <?php endif; ?>

    <div style="margin-top:20px; color:#64748b;">
    💡What's wrong with these words?? - ASSWORD IDDEN IN P................
    </div>

  </div>

</main>

<?php require_once __DIR__ . '/../../views/footer.php'; ?>