<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SENTRIX™ | Sign in</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
  <link href="css/login.css" rel="stylesheet">
</head>
<body>
  <div class="auth-container">
    <div class="auth-logo">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" aria-label="SENTRIX logo">
        <ellipse cx="30" cy="33" rx="19.5" ry="21" fill="#00ffe1" opacity="0.13"/>
        <ellipse cx="30" cy="28" rx="10" ry="10" fill="#00ffe1" opacity="0.28"/>
        <ellipse cx="30" cy="27.7" rx="5.3" ry="5.3" fill="#00ffe1"/>
      </svg>
    </div>

    <div class="auth-title" id="authTitle">SENTRIX™ — Prihlásenie</div>

    <form id="loginForm" autocomplete="off" style="display:block;">
      <div class="mb-3 position-relative">
        <input type="email" class="form-control" id="loginEmail" placeholder="E-mail" required>
      </div>

      <div class="mb-2 position-relative">
        <input type="password" class="form-control" id="loginPassword" placeholder="Heslo" required>
        <span class="show-password-toggle" onclick="togglePassword('loginPassword', this)" title="Zobraziť/Zakryť heslo">
          <i class="bi bi-eye-fill"></i>
        </span>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="#" class="forgot-link" onclick="showReset()">Zabudnuté heslo?</a>
        <a href="index.html" class="forgot-link">Späť na web</a>
      </div>

      <button type="submit" class="btn auth-btn w-100 mb-2">Prihlásiť sa</button>

      <div class="text-end">
        <span class="toggle-link" onclick="toggleForm()">Nemáte účet? Registrujte sa</span>
      </div>

    </form>

    <form id="registerForm" autocomplete="off" style="display:none;">
      <div class="mb-3 position-relative">
        <input type="email" class="form-control" id="registerEmail" placeholder="E-mail" required>
      </div>

      <div class="mb-3 position-relative">
        <input type="text" class="form-control" id="registerUsername" placeholder="Používateľské meno" required>
      </div>

      <div class="mb-2 position-relative">
        <input type="password" class="form-control" id="registerPassword" placeholder="Heslo" required>
        <span class="show-password-toggle" onclick="togglePassword('registerPassword', this)" title="Zobraziť/Zakryť heslo">
          <i class="bi bi-eye-fill"></i>
        </span>
      </div>

      <button type="submit" class="btn auth-btn w-100 mb-2">Registrovať sa</button>

      <div class="text-end">
        <span class="toggle-link" onclick="toggleForm()">Máte účet? Prihláste sa</span>
      </div>

    </form>

    <form id="resetForm" autocomplete="off" style="display:none;">
      <div class="mb-3 position-relative">
        <input type="email" class="form-control" id="resetEmail" placeholder="E-mail" required>
      </div>

      <button type="submit" class="btn auth-btn w-100 mb-2">Obnoviť heslo</button>

      <div class="text-end">
        <span class="toggle-link" onclick="showLogin()">Naspäť na prihlasovanie</span>
      </div>

    </form>

    <div class="other-box">
      <div class="fw-bold mb-2" style="color:#abdce0">
        Prihlásiť sa cez (demo)
      </div>

      <button class="btn provider-btn" type="button" onclick="providerAnim('google')" id="googleBtn">
        <span class="provider-icon">
          <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg"
            style="width:22px;vertical-align:middle" alt="Google">
        </span>
        Google
      </button>

      <button class="btn provider-btn" type="button" onclick="providerAnim('apple')" id="appleBtn">
        <span class="provider-icon"><i class="bi bi-apple" style="font-size:22px;"></i></span>
        Apple
      </button>

    <div class="auth-footer">
      &copy; 2026 SENTRIX™
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/login.js"></script>
</body>
</html>
