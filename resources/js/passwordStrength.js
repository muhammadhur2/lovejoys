import zxcvbn from 'zxcvbn';

document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('password');
    const strengthIndicator = document.getElementById('password-strength-indicator');

    // Function to update the password strength bar
    function updatePasswordStrength() {
        if (!passwordInput || !strengthIndicator) {
            return;
        }

        const result = zxcvbn(passwordInput.value);
        let strengthColor;
        let strengthWidth;

        switch (result.score) {
            case 0:
            case 1:
                strengthColor = 'red'; // Weak
                strengthWidth = '25%';
                break;
            case 2:
                strengthColor = 'orange'; // Fair
                strengthWidth = '50%';
                break;
            case 3:
                strengthColor = 'yellow'; // Good
                strengthWidth = '75%';
                break;
            case 4:
                strengthColor = 'green'; // Strong
                strengthWidth = '100%';
                break;
            default:
                strengthColor = 'transparent';
                strengthWidth = '0%';
        }

        strengthIndicator.style.width = strengthWidth;
        strengthIndicator.style.backgroundColor = strengthColor;
    }

    // Attach the event listener to the password input field
    if (passwordInput) {
        passwordInput.addEventListener('input', updatePasswordStrength);
    }
});
