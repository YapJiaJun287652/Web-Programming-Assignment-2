function validateLoginForm() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (username === '' || password === '') {
        document.getElementById('loginMessage').textContent = 'All fields are required.';
        return false;
    }

    return true;
}

function validateRegistrationForm() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const phone = document.getElementById('phone').value;
    const address = document.getElementById('address').value;

    if (name === '' || email === '' || password === '' || phone === '' || address === '') {
        document.getElementById('registrationMessage').textContent = 'All fields are required.';
        return false;
    }

    return true;
}
