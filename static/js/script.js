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

function deletUser(id) {
    if (!confirm("Tem certeza que deseja excluir?")) return;

    fetch("/Aegis/static/php/deletUser.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + id
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        location.reload();
    });
}
function logout() {
    window.location.replace("/Aegis/static/php/logout.php");
}