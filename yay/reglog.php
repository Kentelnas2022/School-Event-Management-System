<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Event Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            position: relative;
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
            font-size: 14px;
            text-align: left;
        }

        .form-group input {
            width: 100%;
            padding: 10px 40px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-group input[type="submit"] {
            background-color: #333;
            color: white;
            cursor: pointer;
            border: none;
            font-size: 18px;
            padding: 15px;
            transition: background-color 0.3s;
        }

        .form-group input[type="submit"]:hover {
            background-color: #555;
        }

        .icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #888;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            padding-left: 40px;
        }

        .icon-user {
            font-size: 18px;
        }

        .icon-envelope {
            font-size: 18px;
        }

        .icon-lock {
            font-size: 18px;
        }

        .toggle-link {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .toggle-link:hover {
            text-decoration: underline;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>School Event Management System</h1>
        
        <!-- Login Form -->
        <div id="loginForm">
            <div class="form-group">
                <i class="icon icon-envelope">📧</i>
                <input type="email" id="loginEmail" name="loginEmail" placeholder="Email" required>
            </div>
            <div class="form-group">
                <i class="icon icon-lock">🔒</i>
                <input type="password" id="loginPassword" name="loginPassword" placeholder="Password" required minlength="8">
            </div>
            <div class="form-group">
                <input type="submit" value="Login" onclick="handleLogin()">
            </div>
            <a href="#" class="toggle-link" onclick="toggleForm()">Don't have an account? Sign Up</a>
        </div>

        <!-- Signup Form -->
        <div id="signupForm" class="hidden">
            <div class="form-group">
                <i class="icon icon-user">👤</i>
                <input type="text" id="signupUsername" name="signupUsername" placeholder="Username" required>
            </div>
            <div class="form-group">
                <i class="icon icon-envelope">📧</i>
                <input type="email" id="signupEmail" name="signupEmail" placeholder="Email" required>
            </div>
            <div class="form-group">
                <i class="icon icon-lock">🔒</i>
                <input type="password" id="signupPassword" name="signupPassword" placeholder="Password" required minlength="8">
            </div>
            <div class="form-group">
                <i class="icon icon-lock">🔒</i>
                <input type="password" id="signupConfirmPassword" name="signupConfirmPassword" placeholder="Confirm Password" required minlength="8">
            </div>
            <div class="form-group">
                <input type="submit" value="Sign Up" onclick="handleSignup()">
            </div>
            <a href="#" class="toggle-link" onclick="toggleForm()">Already have an account? Login</a>
        </div>
    </div>

    <script>
        function handleLogin() {
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;

            if (email && password) {
                // Add login logic here
                // For example, use AJAX to send a request to your server and handle the response
                alert('Login successful');
                window.location.href = 'dashboard.php'; // Redirect to dashboard on successful login
            } else {
                alert('Please fill in all fields');
            }
        }

        function handleSignup() {
            const username = document.getElementById('signupUsername').value;
            const email = document.getElementById('signupEmail').value;
            const password = document.getElementById('signupPassword').value;
            const confirmPassword = document.getElementById('signupConfirmPassword').value;

            // Validate email format
            if (!email.includes('@')) {
                alert('Please enter a valid email address');
                return;
            }

            // Validate password length
            if (password.length < 8) {
                alert('Password must be at least 8 characters long');
                return;
            }

            // Validate password match
            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return;
            }

            if (username && email && password) {
                // Add signup logic here
                // For example, use AJAX to send a request to your server and handle the response
                alert('Signup successful');
                toggleForm(); // Switch to login form after successful signup
            } else {
                alert('Please fill in all fields');
            }
        }

        function toggleForm() {
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');
            loginForm.classList.toggle('hidden');
            signupForm.classList.toggle('hidden');
        }
    </script>
</body>
</html>
