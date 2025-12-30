<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl w-full max-w-md shadow-lg">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Admin Login</h2>

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
            @csrf

            <div class="flex flex-col">
                <label for="email" class="mb-2 text-gray-700 font-medium">Email</label>
                <input id="email" type="email" placeholder="Enter Admin Email" name="email" required
                       class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                       value="{{ old('email') }}">
            </div>

            <div class="flex flex-col">
                <label for="password" class="mb-2 text-gray-700 font-medium">Password</label>
                <input id="password" type="password" placeholder="Enter Password" name="password" required
                       class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            @if ($errors->any())
                <div class="text-red-500 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition">
                Login
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="#" class="text-blue-600 hover:underline text-sm">Forgot Password?</a>
        </div>
    </div>

</body>
</html>
