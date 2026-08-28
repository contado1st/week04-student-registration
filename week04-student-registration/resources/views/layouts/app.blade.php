<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col justify-between">
    <nav class="bg-blue-900 text-white shadow-md py-4 px-8 flex justify-between items-center">
        <a href="{{ route('students.create') }}" class="text-xl font-bold tracking-wide">PLSP Student Portal</a>
        <a href="{{ route('students.create') }}" class="hover:underline text-sm font-medium">Register Student</a>
    </nav>

    <main class="container mx-auto px-4 py-8 flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-gray-400 text-center py-4 text-sm">
        &copy; {{ date('Y') }} Student Registration System. All rights reserved.
    </footer>
</body>
</html>