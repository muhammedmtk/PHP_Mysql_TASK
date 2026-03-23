<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('inc/connect.php');

if (!isset($_GET['id'])) {
    die("Invalid request");
}

$id_i = (int) $_GET['id'];
$row = Database::getinstance()->getUser($id_i)
?>

<?php include 'navbar.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>View User</title>
  
</head>

<body class="bg-slate-50 min-h-screen">
  <div class="max-w-5xl mx-auto p-6">

    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-slate-800">User Details</h1>
      <a href="index1.php"
         class="inline-flex items-center rounded-lg bg-slate-900 px-4 py-2 text-white text-sm hover:bg-slate-800">
        Add new data
      </a>
    </div>

    <?php if ($row): ?>
      <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-0">

          <!-- Left: Avatar + name -->
          <div class="p-8 flex flex-col items-center justify-center bg-slate-50 border-b md:border-b-0 md:border-r border-slate-200">
            <div class="w-32 h-32 rounded-full overflow-hidden ring-4 ring-white shadow">
              <?php if (!empty($row['image'])): ?>
                <img
                  src="images/<?= htmlspecialchars($row['image']); ?>"
                  alt="user image"
                  class="w-full h-full object-cover"
                >
              <?php else: ?>
                <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-600 text-sm">
                  No Image
                </div>
              <?php endif; ?>
            </div>

            <h2 class="mt-4 text-xl font-semibold text-slate-800">
              Mr. <?= htmlspecialchars($row['first_name'] . " " . $row['last_name']); ?>
            </h2>

            <span class="mt-2 inline-flex items-center rounded-full bg-slate-900 px-3 py-1 text-xs font-medium text-white">
              <?= htmlspecialchars($row['department']); ?>
            </span>

            <div class="mt-5 text-xs text-slate-500">
              ID: <?= htmlspecialchars($row['id']); ?>
            </div>
          </div>

          <!-- Right: Details -->
          <div class="md:col-span-2 p-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

              <div class="space-y-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Full Name</p>
                <p class="text-slate-800 font-medium">
                  <?= htmlspecialchars($row['first_name'] . " " . $row['last_name']); ?>
                </p>
              </div>

              <div class="space-y-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Email</p>
                <p class="text-slate-800 font-medium">
                  <?= htmlspecialchars($row['email']); ?>
                </p>
              </div>

              <div class="space-y-1 sm:col-span-2">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Address</p>
                <p class="text-slate-800 font-medium">
                  <?= htmlspecialchars($row['address']); ?>
                </p>
                <p class="text-sm text-slate-500">
                  <?= htmlspecialchars($row['country']); ?>
                </p>
              </div>

              <div class="space-y-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Gender</p>
                <p class="text-slate-800 font-medium">
                  <?= htmlspecialchars($row['gender']); ?>
                </p>
              </div>

              <div class="space-y-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Skills</p>
                <p class="text-slate-800 font-medium">
                  <?= htmlspecialchars($row['skills']); ?>
                </p>
              </div>

              <div class="space-y-1">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Department</p>
                <p class="text-slate-800 font-medium">
                  <?= htmlspecialchars($row['department']); ?>
                </p>
              </div>

            </div>

            <div class="mt-8 flex flex-wrap gap-3">
              <a href="viewAllDate.php"
                 class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2 text-white text-sm hover:bg-slate-800">
                Back to List
              </a>

              <a href="edit.php?id=<?= (int)$row['id']; ?>"
                 class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-slate-700 text-sm hover:bg-slate-50">
                Edit
              </a>
            </div>
          </div>

        </div>
      </div>

    <?php else: ?>
      <div class="bg-white rounded-xl border border-slate-200 p-6 text-slate-700">
        No data found
      </div>
      <div class="mt-6">
        <a href="viewAllDate.php" class="text-sm text-slate-700 underline">Back to list</a>
      </div>
    <?php endif; ?>

  </div>
</body>
</html>