<?php require_once __DIR__ . '/../../views/header.php'; ?>

<main class="challenge-container">

  <div class="challenge-box">

    <!-- HEADER -->
    <h1 class="challenge-title">🕵️ Hidden Source Lab</h1>

    <p class="challenge-desc">
      Pozri source stránky a nájdi skryté heslo.
    </p>

    <!-- FAKE CONTENT -->
    <div class="terminal-input" style="margin-bottom:15px;">
      <span class="prompt">system:</span>
      <span>Welcome to secure panel...</span>
    </div>

    <!-- 🔥 HIDDEN PASSWORD -->
    <!-- PASSWORD: admin123 -->

    <!-- FORM -->
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

        if ($userAnswer === "admin123") {
            $result = "correct";
        } else {
            $result = "wrong";
        }
    }
    ?>

    <!-- RESULT -->
    <?php if ($result === "correct"): ?>
      <div class="result success">
        ✅ ACCESS GRANTED  
        <br><br>
        FLAG{SOURCE_MASTER}
      </div>
    <?php elseif ($result === "wrong"): ?>
      <div class="result error">
        ❌ WRONG PASSWORD
      </div>
    <?php endif; ?>

    <!-- HINT -->
    <div style="margin-top:20px; color:#64748b;">
      💡 Hint: Pravé tlačidlo → View Page Source
    </div>

  </div>

</main>

<?php require_once __DIR__ . '/../../views/footer.php'; ?>