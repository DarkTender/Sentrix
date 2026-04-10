<?php require_once __DIR__ . '/../../views/header.php'; ?>

<main class="challenge-container">

  <div class="challenge-box">

    <!-- HEADER -->
    <h1 class="challenge-title">🔓 SQL Injection Lab</h1>

    <p class="challenge-desc">
      Tento login systém je zraniteľný. Skús sa prihlásiť bez hesla.
    </p>

    <!-- LOGIN FORM -->
    <form method="POST" class="challenge-form">

      <div class="terminal-input">
        <span class="prompt">username:</span>
        <input type="text" name="username" placeholder="admin">
      </div>

      <div class="terminal-input">
        <span class="prompt">password:</span>
        <input type="password" name="password" placeholder="*****">
      </div>

      <button type="submit" class="challenge-submit">LOGIN</button>

    </form>

    <?php
    $result = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = $_POST['username'];

        // 💀 simulovaná zraniteľná query
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '1234'";

        echo "<div class='result' style='margin-top:10px; font-family:monospace;'>";
        echo "Query: " . htmlspecialchars($query);
        echo "</div>";

        // 🔥 SQLi detekcia (jednoduchá)
        if (strpos($username, "'") !== false && strpos(strtolower($username), "or") !== false) {
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
        FLAG{SQLI_MASTER}
      </div>
    <?php elseif ($result === "wrong"): ?>
      <div class="result error">
        ❌ ACCESS DENIED
      </div>
    <?php endif; ?>

    <!-- HINT -->
    <div style="margin-top:20px; color:#64748b;">
      💡 Hint: Skús použiť `' OR 1=1 --`
    </div>

  </div>

</main>

<?php require_once __DIR__ . '/../../views/footer.php'; ?>