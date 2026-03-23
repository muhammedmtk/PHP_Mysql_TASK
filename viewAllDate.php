<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require('inc/connect.php');

$allDATA = Database::getInstance()->getAllUsers();
?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users Table</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Users List</h1>
        <a href="index1.php" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
           Add New Data
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">First</th>
                    <th class="px-4 py-2 border">Last</th>
                    <th class="px-4 py-2 border">Address</th>
                    <th class="px-4 py-2 border">Country</th>
                    <th class="px-4 py-2 border">Gender</th>
                    <th class="px-4 py-2 border">Skills</th>
                    <th class="px-4 py-2 border">Department</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Image</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($allDATA as $row): ?>
<tr class="text-center hover:bg-gray-100">
  <td class="px-4 py-2 border"><?= (int)$row['id']; ?></td>
  <td class="px-4 py-2 border"><?= htmlspecialchars($row['first_name']); ?></td>
  <td class="px-4 py-2 border"><?= htmlspecialchars($row['last_name']); ?></td>
  <td class="px-4 py-2 border"><?= htmlspecialchars($row['address']); ?></td>
  <td class="px-4 py-2 border"><?= htmlspecialchars($row['country']); ?></td>
  <td class="px-4 py-2 border"><?= htmlspecialchars($row['gender']); ?></td>
  <td class="px-4 py-2 border"><?= htmlspecialchars($row['skills']); ?></td>
  <td class="px-4 py-2 border"><?= htmlspecialchars($row['department']); ?></td>
  <td class="px-4 py-2 border"><?= htmlspecialchars($row['email']); ?></td>


  <td class="px-4 py-2 border">
    <?php if (!empty($row['image'])): ?>
      <img
        src="images/<?= htmlspecialchars($row['image']); ?>"
        alt="user image"
        class="w-16 h-16 object-cover rounded mx-auto"
      >
    <?php else: ?>
      <span class="text-gray-400">No image</span>
    <?php endif; ?>
  </td>

                    <td class="px-4 py-2 border space-x-2">
                        <a href="view1.php?id=<?= $row['id']; ?>" 
                           class="text-green-600 hover:underline">View</a>

                        <a href="edit.php?id=<?= $row['id']; ?>" 
                           class="text-yellow-600 hover:underline">Edit</a>

                        <a href="delete1.php?id=<?= $row['id']; ?>" 
                           class="text-red-600 hover:underline"
                           onclick="return confirm('Are you sure?')">
                           Delete
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>