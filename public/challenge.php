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
<<<<<<< Updated upstream

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userAnswer = trim($_POST['answer']);

    if ($userAnswer === trim($challenge['correct_answer'])) {
        $result = "correct";

        // pridaj body
        $stmt = $conn->prepare("UPDATE users SET score = score + ? WHERE id = ?");
        $stmt->execute([$challenge['points'], $_SESSION['user_id']]);

    } else {
        $result = "wrong";
    }

    // uloženie submission
    $stmt = $conn->prepare("INSERT INTO submissions (user_id, challenge_id, answer, is_correct) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $challenge['id'],
        $userAnswer,
        $result === "correct"
    ]);
}
=======
$userAnswer = "";

// ✅ spracovanie len keď odošleš form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userAnswer = trim($_POST['answer'] ?? "");
    $type = $challenge['type'];

    $correct = false;

    if ($type === "SQLi") {
        if (str_contains($userAnswer, "OR 1=1")) {
            $correct = true;
        }
    }

    if ($type === "XSS") {
        if (str_contains($userAnswer, "<script>")) {
            $correct = true;
        }
    }

    if ($type === "CSRF") {
        if (strtolower($userAnswer) === "csrf token") {
            $correct = true;
        }
    }

    // výsledok
    $result = $correct ? "correct" : "wrong";
}

require_once __DIR__ . '/../views/header.php';
>>>>>>> Stashed changes
?>

<div class="card" style="max-width:600px;">

<<<<<<< Updated upstream
<form method="POST">
  <input type="text" name="answer" placeholder="Your payload">
  <button type="submit">Submit</button>
</form>

<?php if ($result === "correct"): ?>
  <p style="color:green;">✅ Correct!</p>
  <p><strong>Explanation:</strong> <?= $challenge['explanation'] ?></p>
<?php elseif ($result === "wrong"): ?>
  <p style="color:red;">❌ Wrong answer</p>
<?php endif; ?>
=======
  <h2><?= htmlspecialchars($challenge['title']) ?></h2>
  <p style="color:#94a3b8;"><?= htmlspecialchars($challenge['description']) ?></p>

  <form method="POST" style="margin-top:15px;">
    <input 
      type="text" 
      name="answer" 
      placeholder="Enter payload..." 
      value="<?= htmlspecialchars($userAnswer) ?>"
    >

    <button type="submit">Execute</button>
  </form>

</div>

<!-- RESULT -->
<?php if ($result === "correct"): ?>
  <div class="card" style="border-color:#22c55e; margin-top:15px;">
    <h3 style="color:#22c55e;">✔ Access Granted</h3>
    <p><?= htmlspecialchars($challenge['explanation']) ?></p>
  </div>
<?php elseif ($result === "wrong"): ?>
  <div class="card" style="border-color:red; margin-top:15px;">
    <h3 style="color:red;">✖ Access Denied</h3>
    <p style="color:#94a3b8;">Try different payload</p>
  </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../views/footer.php'; ?>
>>>>>>> Stashed changes
