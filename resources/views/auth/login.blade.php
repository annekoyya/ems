<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
    <h2 class="text-2xl font-bold text-center mb-6">Login to Your Account</h2>

    @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
      @csrf
      <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" required
               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:border-blue-400">
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Password</label>
        <input type="password" name="password" required
               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:border-blue-400">
      </div>

      <button type="submit"
              class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
        Login
      </button>
    </form>
  </div>
</body>
</html>