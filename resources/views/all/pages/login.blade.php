<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Mitigation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- remix icon --}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.4.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl flex flex-col md:flex-row w-full max-w-5xl overflow-hidden">
        <!-- Left Section (Login Form) -->
        <div class="w-full md:w-1/2 p-8 md:p-12 space-y-8">
            <div class="text-center md:text-left">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back</h2>
                <p class="text-gray-600">Please sign in to your account</p>
            </div>

            <form action="{{ route('checkLogin') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                <i class="ri-mail-line text-lg"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                                placeholder="Enter your email">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                <i class="ri-lock-line text-lg"></i>
                            </div>
                            <input type="password" id="password" name="password" value="{{ old('password') }}"
                                class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                                placeholder="Enter your password">
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-xl font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform transition duration-150 hover:scale-[1.02]">
                    Sign in
                </button>
            </form>

            <p class="text-center text-gray-600 text-sm">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:text-blue-700">Register here</a>
            </p>
        </div>

        <!-- Right Section (Image) -->
        <div class="w-full md:w-1/2 bg-cover bg-center relative hidden md:block">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/90 to-blue-800/90 mix-blend-multiply"></div>
            <div class="relative h-full" style="background-image: url('{{ asset('img/about/banjir2.jpg') }}')">
                <div class="absolute inset-0 flex flex-col justify-center px-12 text-white space-y-6">
                    <h1 class="text-4xl font-bold leading-tight">Smart Mitigation</h1>
                    <p class="text-lg text-blue-100">Empowering communities with intelligent solutions for disaster prevention and management.</p>
                    <div class="pt-4">
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center px-6 py-3 border-2 border-white text-white font-medium rounded-xl hover:bg-white hover:text-blue-800 transition duration-150 transform hover:scale-[1.02]">
                            Create Account
                            <i class="ri-arrow-right-line ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
