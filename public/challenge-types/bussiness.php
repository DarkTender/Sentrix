<?php require_once __DIR__ . '/../../views/header.php'; ?>

<main class="challenge-container">

  <div class="challenge-box">

    <h1 class="challenge-title">💸 Discount Lab</h1>

    <p class="challenge-desc">
      Použi zľavový kód na nákup.
    </p>

    <form method="POST">
        <div class="terminal-input">
            <span class="prompt">price:</span>
            <input type="number" name="answer" value="100">
        </div>

      <div class="terminal-input">
        <span class="prompt">discount code:</span>
        <input type="hidden" value="102 105 110 97 108 32 60 32 48">
        <input type="text" name="code" placeholder="HOW MUCH DO YOU WANT? 10? 50? 1000? Write Like DISCOUNT10">
      </div>

      <button class="challenge-submit">BUY</button>

    </form>

    <div class="result">

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $price = $_POST['answer'];
        $code = $_POST['code'];

        if ($code === "DISCOUNT10") {
            $price = $price - 10;
        }

        if ($price <= 0) {
            echo "✅ Purchase successful<br>";
            echo "FLAG{LOGIC_BROKEN}";
        } else {
            echo "💰 AND?? I don't give it to you, try again source hacker";
        }
    }
    ?>

    </div>

  </div>

</main>

<?php require_once __DIR__ . '/../../views/footer.php'; ?>