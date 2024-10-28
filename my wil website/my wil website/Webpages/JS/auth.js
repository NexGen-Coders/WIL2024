function handleLogin(form) {
    const username = form.username.value;
    const password = form.password.value;

    const users = JSON.parse(localStorage.getItem("users")) || [];

    const userFound = users.some(user => user.username === username && user.password === password);

    if (userFound) {
        
        window.location.href = 'index.html';
    } else {
        displayError('Invalid username or password');
    }

    return false;
}

function handleSignup(form) {
    const username = form.username.value;
    const password = form.password.value;

    const users = JSON.parse(localStorage.getItem("users")) || [];
    const userExists = users.some(user => user.username === username);

    if (userExists) {
        displayError('Username already taken. Please choose another one.');
    } else {
    
        users.push({ username, password });
        localStorage.setItem("users", JSON.stringify(users));

        alert('Signup successful! Please log in.');
        window.location.href = 'login page.html';
    }

    return false;
}

function displayError(message) {
    const errorMessage = document.getElementById('error-message');
    errorMessage.textContent = message;
}
