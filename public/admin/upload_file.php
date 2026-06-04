<?php
if (
    isset($_FILES['challenge_file']) &&
    $_FILES['challenge_file']['error'] === UPLOAD_ERR_OK
) {

    $uploadDir = __DIR__ . '/../challenge-types/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['challenge_file']['name']);
    echo "<pre>";
    echo "DIR: " . __DIR__ . "\n";
    echo "UPLOAD DIR: " . $uploadDir . "\n";
    echo "REAL PATH: " . realpath($uploadDir) . "\n";
    echo "</pre>";
    if (
        move_uploaded_file(
            $_FILES['challenge_file']['tmp_name'],
            $uploadDir . $fileName
        )
    ) {
        echo "<h2>UPLOAD OK</h2>";
        echo "Saved to: " . $uploadDir . $fileName;
    } else {
        echo "<h2>UPLOAD FAILED</h2>";
    }
}

?>