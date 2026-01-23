const passwordInput = document.getElementById('password');
const toggleButton = document.getElementById('showPassword');
const icon = toggleButton.querySelector('i');
const alert = document.getElementById('uploadAlert');
const registerLink = document.getElementById('register-link');

toggleButton.addEventListener('click', () => {
    const isPassword = passwordInput.type === 'password';

    // Alterna o tipo do input
    passwordInput.type = isPassword ? 'text' : 'password';

    // Alterna o ícone
    icon.classList.toggle('fa-eye', !isPassword);
    icon.classList.toggle('fa-eye-slash', isPassword);
});

document.getElementById('cpf').addEventListener('input', function (e) {
    var valor = e.target.value;
    valor = valor.replace(/\D/g, ""); // Remove tudo o que não é dígito
    valor = valor.replace(/(\d{3})(\d)/, "$1.$2"); // Coloca o primeiro ponto após o terceiro dígito
    valor = valor.replace(/(\d{3})(\d)/, "$1.$2"); // Coloca o segundo ponto após o sexto dígito
    valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2"); // Coloca o traço após o nono dígito

    e.target.value = valor; // Atualiza o valor do input com a máscara
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