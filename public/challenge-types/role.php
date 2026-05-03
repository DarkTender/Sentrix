<?php require_once __DIR__ . '/../../views/header.php'; ?>

<h2>👤 User Panel</h2>

<?php
// ak cookie neexistuje → nastav default
if (!isset($_COOKIE['role'])) {
    setcookie('role', 'user');
    $_COOKIE['role'] = 'user';
}

echo "<p>Your role: " . $_COOKIE['role'] . "</p>";

// ❌ zraniteľná logika
if ($_COOKIE['role'] === "admin") {
    echo "<h3>👑 Admin Access Granted</h3>";
    echo "<p>FLAG: flag{cookie_tampering_success}</p>";
} else {
    echo "<p>Access denied. Admins only.</p>";
}
?>
<form method="POST">
    <input type="hidden" name="answer" value="flag{cookie_tampering_success}">
    <button type="submit">Claim Flag</button>
</form>

<?php require_once __DIR__ . '/../../views/footer.php'; ?>