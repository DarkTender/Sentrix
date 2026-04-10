<?php require_once __DIR__ . '/../../views/header.php'; ?>

<main class="challenge-container">

  <div class="challenge-box">

    <h1 class="challenge-title">🔓 SQL Injection Lab</h1>

    <p class="challenge-desc">
      Tento login systém je zraniteľný. Skús sa prihlásiť bez hesla.
    </p>

    <form method="POST" class="challenge-form">

      <div class="terminal-input">
        <span class="prompt">username:</span>
        <input type="text" name="answer" placeholder="admin">
      </div>

      <button type="submit" class="challenge-submit">LOGIN</button>

    </form>

    <?php
    $result = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = $_POST['answer'];

        if (strpos($username, "'") !== false && strpos(strtolower($username), "or") !== false) {
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
        FLAG{SQLI_MASTER}
      </div>
    <?php elseif ($result === "wrong"): ?>
      <div class="result error">
        ❌ ACCESS DENIED
      </div>
    <?php endif; ?>

    <div style="margin-top:20px; color:#64748b;">
      💡 Hint: Skús použiť čiarka | ALEBO | prvé číslo má rovnaký vzťah s čislom menčím ako dva ale väčšie ako nula| dva rovné pruhy | a čiarkou na konci 
        <br>* (|) znamená medzeru !!!
    </div>

  </div>

</main>

<?php require_once __DIR__ . '/../../views/footer.php'; ?>