<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? '';
?>

<script src="https://cdn.tailwindcss.com"></script>

<nav class="bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="text-lg font-bold">
                ITI - Information Technology Institute
            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-4">

                <?php if($isLoggedIn): ?>

                    <span class="font-semibold">
                        <?= htmlspecialchars($userName) ?>
                    </span>

                    <a href="logout.php"
                       class="bg-white text-red-600 px-4 py-2 rounded hover:bg-gray-200 transition">
                       Logout
                    </a>

                <?php else: ?>

                    <a href="login.php"
                       class="px-4 py-2 border border-white rounded hover:bg-red-700 transition">
                       Login
                    </a>

                    <a href="index1.php"
                       class="bg-white text-red-600 px-4 py-2 rounded hover:bg-gray-200 transition">
                       Register
                    </a>

                <?php endif; ?>

            </div>

        </div>
    </div>
</nav>