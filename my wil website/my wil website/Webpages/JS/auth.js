// Handle login
function handleLogin(form) {
    const username = form.username.value;
    const password = form.password.value;

    // Get users from localStorage (simulation of users.txt)
    const users = JSON.parse(localStorage.getItem("users")) || [];

    // Validate credentials
    const userFound = users.some(user => user.username === username && user.password === password);

    if (userFound) {
        // Redirect to homepage if valid
        window.location.href = 'index.html';
    } else {
        displayError('Invalid username or password');
    }

    return false; // Prevent form submission
}

// Handle signup
function handleSignup(form) {
    const username = form.username.value;
    const password = form.password.value;

    // Check if the username already exists
    const users = JSON.parse(localStorage.getItem("users")) || [];
    const userExists = users.some(user => user.username === username);

    if (userExists) {
        displayError('Username already taken. Please choose another one.');
    } else {
        // Save new user
        users.push({ username, password });
        localStorage.setItem("users", JSON.stringify(users));

        alert('Signup successful! Please log in.');
        window.location.href = 'login page.html';
    }

    return false; // Prevent form submission
}

// Display error message
function displayError(message) {
    const errorMessage = document.getElementById('error-message');
    errorMessage.textContent = message;
}
