</div>
</div>
<script>
function toggleRegister() {
  const panel = document.getElementById('register-panel');
  panel.classList.toggle('active');
}
</script>
<script>
function switchAuth(type) {

  const loginForm = document.getElementById('loginForm');
  const registerForm = document.getElementById('registerForm');

  const loginTab = document.getElementById('loginTab');
  const registerTab = document.getElementById('registerTab');

  if (type === 'login') {
    loginForm.classList.remove('hidden');
    registerForm.classList.add('hidden');

    loginTab.classList.add('active');
    registerTab.classList.remove('active');

  } else {
    loginForm.classList.add('hidden');
    registerForm.classList.remove('hidden');

    loginTab.classList.remove('active');
    registerTab.classList.add('active');
  }
}
</script>
</body>
</html>