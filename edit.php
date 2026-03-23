<?php
session_start();
$errors = $_SESSION['errors'] ?? [];

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    unset($_SESSION['errors']);
    exit();
}

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include('inc/connect.php');

if (!isset($_GET['id'])) {
    die("Invalid request");
}

$id_i = (int) $_GET['id'];
$user = Database::getinstance()->getUser($id_i);

if (!$user) {
    die("User not found");
}

$skillsArray = !empty($user['skills']) ? explode(",", $user['skills']) : [];
$skillsList = ["PHP", "MySQL", "JS", "PostgreSQL"];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<?php include 'navbar.php'; ?>

<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="bg-white shadow-2xl rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">
            Edit User Information
        </h2>

        <form action="update.php" method="post" enctype="multipart/form-data" class="space-y-5">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <input type="hidden" name="old_image" value="<?= htmlspecialchars($user['image']) ?>">

            <div>
                <label class="block text-gray-600 mb-1">First Name</label>
                <input
                    name="first_name"
                    type="text"
                    value="<?= htmlspecialchars($user['first_name']) ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                >
                <?php if(isset($errors['first_name'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['first_name']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-gray-600 mb-1">Last Name</label>
                <input
                    name="last_name"
                    type="text"
                    value="<?= htmlspecialchars($user['last_name']) ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                >
                <?php if(isset($errors['last_name'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['last_name']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-gray-600 mb-1">Address</label>
                <textarea
                    name="address"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 h-24 focus:ring-2 focus:ring-blue-500 outline-none"
                ><?= htmlspecialchars($user['address']) ?></textarea>
                <?php if(isset($errors['address'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['address']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-gray-600 mb-1">Country</label>
                <select
                    name="country"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                >
                    <option value="">Select Country</option>
                    <option value="Egypt" <?= $user['country'] == 'Egypt' ? 'selected' : '' ?>>Egypt</option>
                    <option value="Saudi Arabia" <?= $user['country'] == 'Saudi Arabia' ? 'selected' : '' ?>>Saudi Arabia</option>
                    <option value="UAE" <?= $user['country'] == 'UAE' ? 'selected' : '' ?>>UAE</option>
                    <option value="Jordan" <?= $user['country'] == 'Jordan' ? 'selected' : '' ?>>Jordan</option>
                </select>
                <?php if(isset($errors['country'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['country']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-gray-600 mb-2">Gender</label>
                <div class="flex gap-6">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="gender" value="Male" <?= $user['gender'] == 'Male' ? 'checked' : '' ?> class="accent-blue-600">
                        Male
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="radio" name="gender" value="Female" <?= $user['gender'] == 'Female' ? 'checked' : '' ?> class="accent-blue-600">
                        Female
                    </label>
                </div>
                <?php if(isset($errors['gender'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['gender']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-gray-600 mb-2">Skills</label>
                <div class="flex flex-wrap gap-6">
                    <?php foreach($skillsList as $skill): ?>
                        <label class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="skills[]"
                                value="<?= $skill ?>"
                                <?= in_array($skill, $skillsArray) ? 'checked' : '' ?>
                                class="accent-blue-600"
                            >
                            <?= $skill ?>
                        </label>
                    <?php endforeach; ?>
                </div>
                <?php if(isset($errors['skills'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['skills']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-gray-600 mb-1">Email</label>
                <input
                    name="username"
                    type="text"
                    value="<?= htmlspecialchars($user['email']) ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                >
                <?php if(isset($errors['email'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['email']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-gray-600 mb-1">Password</label>
                <input
                    name="password"
                    type="password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                >
                <?php if(isset($errors['password'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['password']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-gray-600 mb-1">Department</label>
                <input
                    readonly
                    name="department"
                    type="text"
                    value="OpenSource"
                    class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2"
                >
                <?php if(isset($errors['department'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['department']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-gray-600 mb-1">Profile Image</label>
                <input type="file" name="image" id="fileToUpload" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                <?php if (!empty($user['image'])): ?>
                    <div class="mt-3">
                        <img src="images/<?= htmlspecialchars($user['image']) ?>" alt="User image" class="w-28 h-28 object-cover rounded-lg border">
                    </div>
                <?php endif; ?>
                <?php if(isset($errors['image'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['image']; ?></p>
                <?php endif; ?>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <button
                    type="reset"
                    class="px-6 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition"
                >
                    Reset
                </button>

                <button
                    type="submit"
                    name="submit"
                    value="Submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
<?php unset($_SESSION['errors']); ?>