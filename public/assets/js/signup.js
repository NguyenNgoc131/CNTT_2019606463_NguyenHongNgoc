document.addEventListener('DOMContentLoaded', function () {
    var passwordInput = document.getElementById('sign-up-password');
    var confirmPasswordInput = document.getElementById('confirm-password');
    var signUpButton = document.querySelector('#signup-form input[type="submit"]');

    function checkPasswordMatch() {
        if (confirmPasswordInput.value !== passwordInput.value) {
            confirmPasswordInput.style.borderColor = 'red';
            signUpButton.disabled = true;
        } else {
            confirmPasswordInput.style.borderColor = 'green';
            signUpButton.disabled = false;
        }
    }

    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    passwordInput.addEventListener('input', checkPasswordMatch);
});
