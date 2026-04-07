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
?>

<div class="card" style="max-width:600px;">

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
