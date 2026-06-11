<?php

echo "<pre>";
print_r($_FILES);
echo "</pre>";

if (
    isset($_FILES['challenge_file']) &&
    $_FILES['challenge_file']['error'] === UPLOAD_ERR_OK
) {

    $uploadDir = __DIR__ . '/uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['challenge_file']['name']);

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

<form method="POST" enctype="multipart/form-data">

    <input type="file" name="challenge_file">

    <button type="submit">
        TEST UPLOAD
    </button>

</form>