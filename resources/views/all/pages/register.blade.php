<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- remix icon --}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.4.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body class="flex items-center justify-center h-screen" style="background-color: #283F50;">
    <div class="bg-white h-[650px] shadow-xl rounded-xl flex max-w-4xl w-full overflow-hidden">
        <div class="w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-2xl font-bold font-monospace text-center mb-2">Login</h2>
            <p class="text-center text-sm text-gray-600 mb-6">Masukkan Email dan Password anda</p>
            <form action="{{ route('checkRegister') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-5">
                    <label for="nama" class="block text-sm font-medium text-black">Nama Lengkap</label>
                    <div
                        class="flex items-center border border-gray-300 rounded-md p-2 space-x-3 mt-1 focus-within:border-black">
                        <span class="material-icons text-blue-700"><i class="ri-user-line"></i></span>
                        <input type="text" id="nama" placeholder="Masukkan nama anda" name="nama"
                            class="w-full outline-none px-2 focus:border-black">
                    </div>
                </div>
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-black">Email</label>
                    <div
                        class="flex items-center border border-gray-300 rounded-md p-2 space-x-3 mt-1 focus-within:border-black">
                        <span class="material-icons text-blue-700"><i class="ri-mail-line"></i></span>
                        <input type="email" id="email" placeholder="Masukkan email anda" name="email"
                            class="w-full outline-none px-2 focus:border-black">
                    </div>
                </div>
                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-black">Password</label>
                    <div
                        class="flex items-center border border-gray-300 rounded-md p-2 space-x-3 mt-1 focus-within:border-black">
                        <span class="material-icons text-blue-700"><i class="ri-key-2-fill"></i></span>
                        <input type="password" id="password" placeholder="Masukkan password anda" name="password"
                            class="w-full outline-none px-2 focus:border-black">
                    </div>
                </div>
                <div class="mb-5">
                    <label for="confirm_password" class="block text-sm font-medium text-black">Konfirmasi
                        Password</label>
                    <div
                        class="flex items-center border border-gray-300 rounded-md p-2 space-x-3 mt-1 focus-within:border-black">
                        <span class="material-icons text-blue-700"><i class="ri-key-2-fill"></i></span>
                        <input type="password" id="confirm_password" placeholder="Masukkan konfirmasi password anda"
                            name="confirm_password" class="w-full outline-none px-2 focus:border-black">
                    </div>
                </div>
                <div class="mb-5">
                    <label for="no_hp" class="block text-sm font-medium text-black">No HP</label>
                    <div
                        class="flex items-center border border-gray-300 rounded-md p-2 space-x-3 mt-1 focus-within:border-black">
                        <span class="material-icons text-blue-700"><i class="ri-phone-line"></i></span>
                        <input type="text" id="no_hp" placeholder="Masukkan no hp anda" name="no_hp"
                            class="w-full outline-none px-2 focus:border-black">
                    </div>
                </div>
                <button
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">REGISTER</button>
            </form>
        </div>

        <!-- Right Section (Login Form) -->
        <div class="w-1/2 bg-cover bg-center relative"
            style="background-image: url('{{ asset('img/about/banjir2.jpg') }}')">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <div class="relative z-10 p-8 text-center text-white flex flex-col items-center justify-center h-full">
                <h1 class="text-3xl font-bold">Smart Mitigation</h1>
                <p class="mt-4 text-sm">Smart Mitigation Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Ducimus deserunt corporis laudantium delectus excepturi nisi. Sapiente aut nihil quod iure, velit
                    temporibus fugit molestias ullam adipisci harum atque expedita nulla.</p>
                <a href="{{ route('login') }}"
                    class="mt-20 bg-transparent border-2 border-white text-white font-bold px-4 py-2 rounded-md w-96 hover:bg-white hover:text-black hover:transition duration-300">LOGIN</a>
            </div>
        </div>
    </div>
</body>

</html>
