<?php

session_start();

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../app/core/Database.php';
require_once __DIR__ . '/../../app/models/Challenge.php';

$db = new Database();
$conn = $db->connect();

$challengeModel = new Challenge($conn);

$id = $_GET['id'];

$challenge = $challengeModel->getById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $challengeModel->update($id, [

        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'category' => $_POST['type'],
        'difficulty' => $_POST['difficulty'],
        'flag' => $_POST['answer'],
        'points' => $_POST['points']

    ]);

    header("Location: admin.php");
    exit;
}
?>

<form method="POST">

    <input type="text"
           name="title"
           value="<?= htmlspecialchars($challenge['title']) ?>">

    <textarea name="description"><?= htmlspecialchars($challenge['description']) ?></textarea>

    <input type="text"
           name="type"
           value="<?= htmlspecialchars($challenge['type']) ?>">

    <input type="text"
           name="difficulty"
           value="<?= htmlspecialchars($challenge['difficulty']) ?>">

    <input type="number"
           name="points"
           value="<?= $challenge['points'] ?>">

    <input type="text"
           name="answer"
           value="<?= htmlspecialchars($challenge['correct_answer']) ?>">

    <button type="submit">
        Save
    </button>

</form>