<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - FutureCloud</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<!-- Menambahkan px-4 agar tidak menempel di sisi layar saat mode mobile -->
<body class="bg-gray-900 flex items-center justify-center h-screen px-4">
    
    <!-- Mengganti w-96 (fixed width) menjadi w-full max-w-md (responsive width) -->
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Admin Panel</h1>
            <p class="text-gray-500 text-sm">Masuk menggunakan Username</p>
        </div>

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username" required autofocus 
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" required 
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            @if($errors->any())
                <p class="text-red-500 text-xs italic mb-4">{{ $errors->first() }}</p>
            @endif
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                LOGIN
            </button>
        </form>
    </div>
</body>
</html>