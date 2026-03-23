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

?>
<?php include 'navbar.php'; ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit User</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-3xl bg-white shadow-2xl rounded-2xl p-8">

    <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">
        Edit User Information
    </h2>

   <form action="update.php" method="post" enctype="multipart/form-data" class="space-y-5">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <!-- First Name -->
        <div>
            <label class="block text-gray-600 mb-1">First Name</label>
            <input name="first_name" type="text"
                value="<?= htmlspecialchars($user['first_name']) ?>"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                <?php if(isset($errors['first_name'])): ?>
                <p style="color:red"><?= $errors['first_name']; ?></p>
                <?php endif; ?>
        </div>

        <!-- Last Name -->
        <div>
            <label class="block text-gray-600 mb-1">Last Name</label>
            <input name="last_name" type="text"
                value="<?= htmlspecialchars($user['last_name']) ?>"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                <?php if (isset($errors['last_name'] )): ?>
                <p style="color:red"><?= $errors['last_name'] ; ?></p>
                <?php endif;?>
        </div>

        <!-- Address -->
        <div>
            <label class="block text-gray-600 mb-1">Address</label>
            <textarea name="address"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 h-24 focus:ring-2 focus:ring-blue-500 outline-none"><?= htmlspecialchars($user['address']) ?></textarea>
                <?php if (isset($errors['address'])):?>
                <p style="color:red"><?= $errors['address']; ?></p>
                <?php endif;?>
            </div>

        <!-- Country -->
        <div>
            <label class="block text-gray-600 mb-1">Country</label>
            <select name="country"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                <option value="">Select Country</option>
                <option value="Egypt" <?= $user['country']=='Egypt'?'selected':'' ?>>Egypt</option>
                <option value="Saudi Arabia" <?= $user['country']=='Saudi Arabia'?'selected':'' ?>>Saudi Arabia</option>
                <option value="UAE" <?= $user['country']=='UAE'?'selected':'' ?>>UAE</option>
                <option value="Jordan" <?= $user['country']=='Jordan'?'selected':'' ?>>Jordan</option>
            </select>
        <?php if (isset($errors['country'] )):?>
          <p style="color:red"><?= $errors['country'] ; ?></p>
          <?php endif;?>
        </div>

        <!-- Gender -->
        <div>
            <label class="block text-gray-600 mb-2">Gender</label>
            <div class="flex gap-6">
                <label class="flex items-center gap-2">
                    <input type="radio" name="gender" value="Male"
                        <?= $user['gender']=='Male'?'checked':'' ?>
                        class="accent-blue-600">
                    Male
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="gender" value="Female"
                        <?= $user['gender']=='Female'?'checked':'' ?>
                        class="accent-blue-600">
                    Female
                </label>
            </div>
        <?php if (isset($errors['gender'])): ?>
        <p style="color:red;"> <?php echo $errors['gender']; ?> </p>
       <?php endif; ?>
        </div>

        <!-- Skills -->
        <div>
            <label class="block text-gray-600 mb-2">Skills</label>
            <div class="flex flex-wrap gap-6">
                <?php 
                $skillsArray = explode(",", $user['skills']);
                $skillsList = ["PHP","MySQL","JS","PostgreSQL"];
                foreach($skillsList as $skill):
                ?>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="skills[]" value="<?= $skill ?>"
                            <?= in_array($skill,$skillsArray)?'checked':'' ?>
                            class="accent-blue-600">
                        <?= $skill ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php if (isset($errors['skills'])):?>
          <p style="color:red"><?= $errors['skills']; ?></p>
        <?php endif;?>
        </div>

        <!-- Email -->
        <div>
            <label class="block text-gray-600 mb-1">Email</label>
            <input name="username" type="text"
                value="<?= htmlspecialchars($user['email']) ?>"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
          <?php if (isset($errors['email'])): ?>
          <p style="color:red;"><?php echo $errors['email']; ?></p>
          <?php endif; ?>
        </div>

        <!-- Password -->
        <div>
            <label class="block text-gray-600 mb-1">Password</label>
            <input name="password" type="password"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
          <?php if (isset($errors['password'])): ?>
          <p style="color:red;"><?php echo $errors['password']; ?></p>
          <?php endif; ?>
        </div>

        <!-- Department -->
        <div>
            <label class="block text-gray-600 mb-1">Department</label>
            <input readonly name="department" type="text" value="OpenSource"
                class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2">
        
          <?php if (isset($errors['department'])): ?>
          <p style="color:red;"><?php echo $errors['department']; ?></p>
          <?php endif; ?>    
            </div>

           <!--add pic-->
      <input type="hidden" name="old_image" value="<?= $user['image'] ?>">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-start">
      <input type="file" name="image" id="fileToUpload">
       <?php if (isset($errors['image'])): ?>
          <p style="color:red;"><?php echo $errors['image']; ?></p>
          <?php endif; ?>  
      </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-4 pt-4">
            <button type="reset"
                class="px-6 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">
                Reset
            </button>

            <button type="submit"  name="submit" value="Submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Update
            </button>
        </div>

    </form>

</div>

</body>
</html>