<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-xl p-8 max-w-md text-center">
        <h1 class="text-2xl font-bold text-red-600 mb-4">403 - Akses Ditolak</h1>
        <p class="text-gray-600 mb-6">
            Maaf, kamu tidak memiliki akses untuk halaman ini.
        </p>

        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Kembali ke Dashboard
        </a>
    </div>

</body>

</html>
