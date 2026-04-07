<?php require_once __DIR__ . '/../../views/header.php'; ?>

<main class="challenge-container">

  <div class="challenge-box">

    <h1 class="challenge-title">📂 LFI Lab</h1>

    <p class="challenge-desc">
      Získaj obsah <code>/etc/passwd</code> pomocou inputu.
    </p>

    <!-- FORM -->
    <form method="GET">

    <input type="hidden" name="id" value="<?= htmlspecialchars($challenge['id']) ?>">

    <div class="terminal-input">
        <span class="prompt">file:</span>
        <input type="text" name="file">
    </div>

      <button type="submit" class="challenge-submit">LOAD</button>

    </form>

    <?php
    $result = null;

    if (isset($_GET['file'])) {

        $file = $_GET['file'];

        echo "<div class='result' style='margin-top:15px; font-family:monospace;'>";

        // 🔥 simulácia LFI
        if (strpos($file, "etc/passwd") !== false) {

            echo "root:x:0:0:root:/root:/bin/bash<br>";
            echo "daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin<br>";
            echo "www-data:x:33:33:www-data:/var/www:/usr/sbin/nologin<br>";
            echo "user:x:1000:1000:user:/home/user:/bin/bash<br><br>";

            echo "<strong>FLAG{LFI_MASTER}</strong>";

        } else {
            echo "File not found.";
        }

        echo "</div>";
    }
    ?>

    <!-- HINT -->
    <div style="margin-top:20px; color:#64748b;">
      💡 Hint: Skús použiť <code>../../../../etc/passwd</code>
    </div>

  </div>

</main>

<?php require_once __DIR__ . '/../../views/footer.php'; ?>