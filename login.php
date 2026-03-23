<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>


  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center p-4">

  <div class="w-full max-w-md bg-white rounded-2xl shadow p-6">
    <h1 class="text-2xl font-semibold text-gray-800">Sign in</h1>
    <p class="text-sm text-gray-500 mt-1">Enter your email and password to continue.</p>

    <form action="login_post.php" method="POST" class="mt-6 space-y-4">

    <?php if(isset($user_error)): ?>
    <p class="mt-3 text-sm text-red-600"><?php echo $user_error; ?></p>
    <?php endif; ?>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="you@example.com"
          required
          class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900
                 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        />
      <?php if(isset($email_error)): ?>
      <p class="mt-1 text-sm text-red-600"><?php echo $email_error; ?></p>
      <?php endif; ?>
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="••••••••"
          required
          class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900
                 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        />
        <?php if(isset($pass_error)): ?>
        <p class="mt-1 text-sm text-red-600"><?php echo $pass_error; ?></p>
        <?php endif; ?>
      </div>

      <!-- Submit -->
      <button
        type="submit"
        name="submit"
        class="w-full rounded-lg bg-blue-600 text-white py-2 font-medium
               hover:bg-blue-700 transition"
      >
        Sign in
      </button>

      <!-- Footer -->
      <p class="text-center text-sm text-gray-500">
        Don’t have an account?
        <a href="index1.php" class="text-blue-600 hover:underline">Create one</a>
      </p>

    </form>
  </div>

</body>
</html>