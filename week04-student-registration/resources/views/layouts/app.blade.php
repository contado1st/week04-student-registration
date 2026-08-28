<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus | Student Registration System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 font-sans min-h-screen flex flex-col justify-between selection:bg-blue-600 selection:text-white bg-[linear-gradient(to_right,#27272a_1px,transparent_1px),linear-gradient(to_bottom,#27272a_1px,transparent_1px)] [background-size:32px_32px]">
    <!-- Campus Navbar -->
    <nav class="bg-zinc-900/90 backdrop-blur-md border-b border-zinc-800 text-white sticky top-0 z-50 py-4 px-6 md:px-12 flex justify-between items-center">
        <a href="{{ route('students.create') }}" class="flex items-center space-x-2 text-xl font-extrabold tracking-wider uppercase">
            <span class="text-blue-500">CAMPUS</span>
            <span class="text-zinc-400 text-xs tracking-widest font-normal border-l border-zinc-700 pl-3">STUDENT REGISTRATION</span>
        </a>
        <a href="{{ route('students.create') }}" class="text-xs font-semibold uppercase tracking-widest bg-blue-600/10 text-blue-400 border border-blue-500/30 px-4 py-2 rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-200">
            + Register Student
        </a>
    </nav>

    <!-- Main Content Container -->
    <main class="container mx-auto px-4 py-10 flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-900/80 border-t border-zinc-800/80 text-zinc-500 text-center py-6 text-xs uppercase tracking-widest">
        &copy; {{ date('Y') }} Campus Student Registration. All rights reserved.
    </footer>
</body>
</html>