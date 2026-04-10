<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /Sentrix/public/login.php");
    exit;
}

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/models/Challenge.php';

$db = new Database();
$conn = $db->connect();

$challengeModel = new Challenge($conn);

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: /Sentrix/public/challenges.php");
    exit;
}

$challenge = $challengeModel->getById($id);

if (!$challenge) {
    echo "Challenge not found";
    exit;
}

$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {

    $userAnswer = trim($_POST['answer'] ?? $_POST['file'] ?? $_GET['file'] ?? '');
    // 💣 BUSINESS LOGIC FIX
    if ($challenge['type'] === 'bussiness') {
        $price = $_POST['answer'] ?? 0;

        if ($price < 0) {
            $userAnswer = "LOGIC_BYPASS";
        }
    }
    if (
       $userAnswer === trim($challenge['correct_answer']) ||
        strpos($userAnswer, $challenge['correct_answer']) !== false
    ) {

        $check = $conn->prepare("
            SELECT * FROM submissions 
            WHERE user_id = ? AND challenge_id = ? AND is_correct = 1
        ");
        $check->execute([$_SESSION['user_id'], $challenge['id']]);

        if ($check->rowCount() == 0) {

            $stmt = $conn->prepare("
                INSERT INTO submissions (user_id, challenge_id, answer, is_correct) 
                VALUES (?, ?, ?, 1)
            ");
            $stmt->execute([
                $_SESSION['user_id'],
                $challenge['id'],
                $userAnswer
            ]);

            $stmt = $conn->prepare("
                UPDATE users SET score = score + ? WHERE id = ?
            ");
            $stmt->execute([$challenge['points'], $_SESSION['user_id']]);
        }

        $result = "correct";

    } else {

        $stmt = $conn->prepare("
            INSERT INTO submissions (user_id, challenge_id, answer, is_correct) 
            VALUES (?, ?, ?, 0)
        ");
        $stmt->execute([
            $_SESSION['user_id'],
            $challenge['id'],
            $userAnswer
        ]);

        $result = "wrong";
    }
}
?>


<?php 
$type = strtolower(trim($challenge['type'] ?? 'flag'));

$file = __DIR__ . '/challenge-types/' . $type . '.php';

if (!file_exists($file)) {
    echo "❌ File not found: " . $file;
    exit;
}

require $file;
exit;?>

