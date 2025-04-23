<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .form-container {
            transition: opacity 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-700">Welcome to MogTech Co Ltd</h2>
            <p class="text-gray-500">Please log in or create an account</p>
        </div>

        <div class="space-y-4">
            <!-- Login Form -->
            <div id="login-form" class="form-container">
                <form action="/login" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="block text-gray-600">Email</label>
                        <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="password" class="block text-gray-600">Password</label>
                        <input type="password" id="password" name="password" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="flex justify-between items-center">
                        <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600 focus:outline-none">Log In</button>
                    </div>
                </form>
                <p class="text-center text-sm text-gray-500 mt-4">Don't have an account? <a href="#" onclick="toggleForm('register')" class="text-blue-500 hover:text-blue-700">Create one</a></p>
            </div>

            <!-- Register Form -->
            <div id="register-form" class="form-container hidden opacity-0">
                <form action="/register" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-gray-600">Full Name</label>
                        <input type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="email-register" class="block text-gray-600">Email</label>
                        <input type="email" id="email-register" name="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="password-register" class="block text-gray-600">Password</label>
                        <input type="password" id="password-register" name="password" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-gray-600">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="flex justify-between items-center">
                        <button type="submit" class="w-full bg-green-500 text-white p-3 rounded-lg hover:bg-green-600 focus:outline-none">Register</button>
                    </div>
                </form>
                <p class="text-center text-sm text-gray-500 mt-4">Already have an account? <a href="#" onclick="toggleForm('login')" class="text-blue-500 hover:text-blue-700">Log in</a></p>
            </div>

        </div>
    </div>

    <script>
        function toggleForm(formType) {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            
            if (formType === 'login') {
                registerForm.classList.add('hidden');
                loginForm.classList.remove('hidden');
                registerForm.classList.add('opacity-0');
                loginForm.classList.remove('opacity-0');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                loginForm.classList.add('opacity-0');
                registerForm.classList.remove('opacity-0');
            }
        }
    </script>
</body>
</html>