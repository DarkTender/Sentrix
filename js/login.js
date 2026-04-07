function providerAnim(provider) {
    let btn = document.getElementById(provider + 'Btn');
    btn.style.boxShadow = "0 0 28px #00ffd0";
    btn.style.transform = "scale(1.08)";
    setTimeout(()=> {
      btn.style.boxShadow = "";
      btn.style.transform = "";
    }, 420);
    alert("Prihlásenie cez " + (provider === "google" ? "Google" : "Apple"));
  }
  function togglePassword(id, el) {
    let input = document.getElementById(id);
    if (input.type === "password") {
      input.type = "text";
      el.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
    } else {
      input.type = "password";
      el.innerHTML = "<i class='bi bi-eye-fill'></i>";
    }
  }
  function toggleForm() {
    let loginForm = document.getElementById('loginForm');
    let registerForm = document.getElementById('registerForm');
    let resetForm = document.getElementById('resetForm');
    let title = document.getElementById('authTitle');
    if (loginForm.style.display !== "none") {
      loginForm.style.display = "none";
      registerForm.style.display = "block";
      resetForm.style.display = "none";
      title.innerText = "Registrácia";
    } else {
      loginForm.style.display = "block";
      registerForm.style.display = "none";
      resetForm.style.display = "none";
      title.innerText = "Prihlásenie";
    }
  }
  function showReset() {
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('registerForm').style.display = 'none';
    document.getElementById('resetForm').style.display = 'block';
    document.getElementById('authTitle').innerText = "Obnova hesla";
  }
  function showLogin() {
    document.getElementById('loginForm').style.display = 'block';
    document.getElementById('registerForm').style.display = 'none';
    document.getElementById('resetForm').style.display = 'none';
    document.getElementById('authTitle').innerText = "Prihlásenie";
  }
  // Validácie demo
  document.getElementById('loginForm').addEventListener('submit', function(e){
    e.preventDefault();
    alert("Prihlasujete sa...");
  });
  document.getElementById('registerForm').addEventListener('submit', function(e){
    e.preventDefault();
    alert("Registrujete sa...");
  });
  document.getElementById('resetForm').addEventListener('submit', function(e){
    e.preventDefault();
    alert("Link na obnovenie hesla bol odoslaný.");
  });

function redirectBackIfNotLoggedIn() {
const isLoggedIn = false; 
if (!isLoggedIn) {
  history.back(); 
}
}