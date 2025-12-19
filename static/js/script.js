const passwordInput = document.getElementById('password');
const toggleButton = document.getElementById('showPassword');
const icon = toggleButton.querySelector('i');

toggleButton.addEventListener('click', () => {
    const isPassword = passwordInput.type === 'password';

    // Alterna o tipo do input
    passwordInput.type = isPassword ? 'text' : 'password';

    // Alterna o ícone
    icon.classList.toggle('fa-eye', !isPassword);
    icon.classList.toggle('fa-eye-slash', isPassword);
});