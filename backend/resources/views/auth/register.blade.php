<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Peminjam</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-2">Daftar Akun</h1>
        <p class="text-gray-500 text-center mb-6">Buat akun peminjam baru</p>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <label class="block mb-1 font-medium">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}"
                required
                class="w-full border rounded-lg p-3 mb-4">

            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                required
                class="w-full border rounded-lg p-3 mb-4">

            <label class="block mb-1 font-medium">Password</label>
            <input type="password" name="password"
                required minlength="8"
                class="w-full border rounded-lg p-3 mb-4">

            <label class="block mb-1 font-medium">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                required minlength="8"
                class="w-full border rounded-lg p-3 mb-5">

            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold p-3 rounded-lg">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm mt-5">
            Sudah punya akun?
            <a href="{{ route('login') }}"
                class="text-blue-600 hover:underline">Login</a>
        </p>
    </div>

</body>
</html>