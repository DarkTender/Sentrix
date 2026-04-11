<?php require_once __DIR__ . '/../../views/header.php'; ?>

<main class="challenge-container">

<div class="challenge-box">

<h1 class="challenge-title">👑 JWT Lab</h1>

<p class="challenge-desc">
Skús získať admin prístup pomocou tokenu.
</p>

<?php

function base64url_decode($data) {
    return base64_decode(str_replace(['-', '_'], ['+', '/'], $data));
}

$token = $_GET['token'] ?? '';

if ($token) {

    $parts = explode('.', $token);

    if (count($parts) === 3) {

        $payload = json_decode(base64url_decode($parts[1]), true);

        echo "<pre>";
        print_r($payload);
        echo "</pre>";

        if ($payload['role'] === 'admin') {
            echo "<br><strong>FLAG{JWT_HACKED}</strong>";
        } else {
            echo "<br>❌ Not admin";
        }

    } else {
        echo "Invalid token";
    }

} else {
    echo "<p>💡 Try adding ?token=...</p>";
}

?>

<div style="margin-top:20px; color:#64748b;">
💡 Hint: JWT = header.payload.signature
</div>

</div>
</main>

<?php require_once __DIR__ . '/../../views/footer.php'; ?>