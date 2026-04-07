<?php
session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/models/Challenge.php';

$db = new Database();
$conn = $db->connect();

$challengeModel = new Challenge($conn);

$id = $_GET['id'] ?? null;
$challenge = $challengeModel->getById($id);

if (!$challenge) {
    echo "Challenge not found";
    exit;
}

$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userAnswer = trim($_POST['answer']);

    if ($userAnswer === trim($challenge['correct_answer'])) {
        $result = "correct";

        $stmt = $conn->prepare("UPDATE users SET score = score + ? WHERE id = ?");
        $stmt->execute([$challenge['points'], $_SESSION['user_id']]);

    } else {
        $result = "wrong";
    }

    $stmt = $conn->prepare("INSERT INTO submissions (user_id, challenge_id, answer, is_correct) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $challenge['id'],
        $userAnswer,
        $result === "correct"
    ]);
}
?>
<?php require_once __DIR__ . '/../views/header.php'; ?>

<main class="challenge-container">

  <div class="challenge-box">

    <div class="challenge-top">
      <h1 class="challenge-title"><?= $challenge['title'] ?></h1>
      <span class="challenge-type"><?= $challenge['type'] ?></span>
    </div>

    <div class="challenge-desc">
      <?= nl2br(htmlspecialchars($challenge['description'])) ?>
    </div>

    <form method="POST" class="challenge-form">

      <div class="terminal-input">
        <span class="prompt">root@satrix:~$</span>
        <input type="text" name="answer" placeholder="Enter payload..." required>
      </div>

      <button type="submit" class="challenge-submit">EXECUTE</button>

    </form>

    <?php if ($result === "correct"): ?>
      <div class="result success">
        ✅ ACCESS GRANTED

        <div class="explanation">
          <strong>Explanation:</strong><br>
          <?= $challenge['explanation'] ?>
        </div>
      </div>

    <?php elseif ($result === "wrong"): ?>
      <div class="result error">
        ❌ ACCESS DENIED
      </div>
    <?php endif; ?>

  </div>

</main>

<?php require_once __DIR__ . '/../views/footer.php'; ?>
