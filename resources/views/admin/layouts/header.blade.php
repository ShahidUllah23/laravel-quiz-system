<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard | Quiz App')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-indigo-600 text-white flex items-center justify-center rounded-lg font-bold">
                        Q
                    </div>
                    <span class="text-xl font-semibold text-gray-800">
                        Quiz App
                    </span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-gray-700 font-medium hover:text-indigo-600">Dashboard</a>
                    <a href="{{ route('admin.categories') }}"
                        class="text-gray-700 font-medium hover:text-indigo-600">Categories</a>
                    <a href="{{ route('admin.quizzes') }}"
                        class="text-gray-700 font-medium hover:text-indigo-600">Quizzes</a>
                </div>

                <!-- Admin Info & Logout -->
                <div class="hidden md:flex items-center gap-4">
                    <span class="text-gray-600 font-medium">{{ session('admin_name') }}</span>
                    <a href="{{ route('admin.logout') }}"
                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Logout</a>
                </div>

                <!-- Mobile Button -->
                <div class="md:hidden">
                    <button onclick="toggleMenu()" class="text-gray-700 text-2xl font-bold focus:outline-none">
                        ☰
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden bg-white border-t md:hidden">
            <div class="px-6 py-4 space-y-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="block text-gray-700 font-medium hover:text-indigo-600">Dashboard</a>
                <a href="{{ route('admin.categories') }}"
                    class="block text-gray-700 font-medium hover:text-indigo-600">Categories</a>
                <a href="{{ route('admin.quizzes') }}"
                    class="block text-gray-700 font-medium hover:text-indigo-600">Quizzes</a>

                <div class="border-t pt-4">
                    <p class="text-gray-600 mb-2 font-medium">{{ session('admin_name') }}</p>
                    <a href="{{ route('admin.logout') }}"
                        class="block text-center bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="max-w-7xl mx-auto px-6 py-10">
        @yield('content')
    </main>

    <!-- Alpine.js for dynamic behavior (optional) -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function toggleMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }
    </script>

</body>

</html>
