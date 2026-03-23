<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Registration</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">
  <div class="max-w-3xl mx-auto bg-white border border-gray-200 shadow-xl rounded-2xl p-8">

    <h1 class="text-2xl font-bold text-gray-700 mb-6 text-center">Registration</h1>

    <form action="register_post.php" method="post"  enctype="multipart/form-data" class="space-y-5">

      <!-- First Name -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-start">
        <label for="first_name" class="md:col-span-1 text-gray-600 mt-2">First Name</label>
        <input id="first_name" name="first_name" type="text"
          class="md:col-span-3 w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500" />
          <?php if(isset($errors['first_name'])): ?>
          <p style="color:red"><?= $errors['first_name']; ?></p>
          <?php endif; ?>
      </div>

      <!-- Last Name -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-start">
        <label for="last_name" class="md:col-span-1 text-gray-600 mt-2">Last Name</label>
        <input id="last_name" name="last_name" type="text"
          class="md:col-span-3 w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500" />
          <?php if (isset($errors['last_name'] )): ?>
          <p style="color:red"><?= $errors['last_name'] ; ?></p>
          <?php endif;?>
      </div>

      <!-- Address -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-start">
        <label for="address" class="md:col-span-1 text-gray-600 mt-2">Address</label>
        <textarea id="address" name="address"
          class="md:col-span-3 w-full border border-gray-300 rounded-lg px-4 py-2 h-28 resize-y outline-none focus:ring-2 focus:ring-blue-500"></textarea>
          <?php if (isset($errors['address'])):?>
          <p style="color:red"><?= $errors['address']; ?></p>
          <?php endif;?>
      </div>

      <!-- Country -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-start">
        <label for="country" class="md:col-span-1 text-gray-600 mt-2">Country</label>
        <select id="country" name="country"
          class="md:col-span-3 w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
          <option value="" selected>Select Country</option>
          <option value="Egypt">Egypt</option>
          <option value="Saudi Arabia">Saudi Arabia</option>
          <option value="UAE">UAE</option>
          <option value="Jordan">Jordan</option>
        </select>
        <?php if (isset($errors['country'] )):?>
          <p style="color:red"><?= $errors['country'] ; ?></p>
          <?php endif;?>
      </div>

      <!-- Gender -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-start">
        <label class="md:col-span-1 text-gray-600 mt-2">Gender</label>
        <div class="md:col-span-3 flex flex-wrap gap-6">
          <label class="flex items-center gap-2 text-gray-700">
            <input type="radio" name="gender" value="Male" class="accent-blue-600">
            Male
          </label>
          <label class="flex items-center gap-2 text-gray-700">
            <input type="radio" name="gender" value="Female" class="accent-blue-600">
            Female
          </label>
        </div>
        <?php if (isset($errors['gender'])): ?>
        <p style="color:red;"> <?php echo $errors['gender']; ?> </p>
       <?php endif; ?>
      </div>

      <!-- Skills -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-start">
        <label class="md:col-span-1 text-gray-600 mt-2">Skills</label>
        <div class="md:col-span-3 flex flex-wrap gap-6">
          <label class="flex items-center gap-2 text-gray-700">
            <input type="checkbox" name="skills[]" value="PHP" class="accent-blue-600">
            PHP
          </label>
          <label class="flex items-center gap-2 text-gray-700">
            <input type="checkbox" name="skills[]" value="MySQL" class="accent-blue-600">
            MySQL
          </label>
          <label class="flex items-center gap-2 text-gray-700">
            <input type="checkbox" name="skills[]" value="J2SE" class="accent-blue-600">
            JS
          </label>
          <label class="flex items-center gap-2 text-gray-700">
            <input type="checkbox" name="skills[]" value="PostgreSQL" class="accent-blue-600">
            PostgreSQL
          </label>
        </div>
        <?php if (isset($errors['skills'])):?>
          <p style="color:red"><?= $errors['skills']; ?></p>
        <?php endif;?>
      </div>

      <!-- Email -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-start">
        <label for="username" class="md:col-span-1 text-gray-600 mt-2">Email</label>
        <input id="username" name="username" type="text"
          class="md:col-span-3 w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500" />
          <?php if (isset($errors['email'])): ?>
          <p style="color:red;"><?php echo $errors['email']; ?></p>
          <?php endif; ?>
      </div>

      <!-- Password -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-start">
        <label for="password" class="md:col-span-1 text-gray-600 mt-2">Password</label>
        <input id="password" name="password" type="password"
          class="md:col-span-3 w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500" />
          <?php if (isset($errors['password'])): ?>
          <p style="color:red;"><?php echo $errors['password']; ?></p>
          <?php endif; ?>
      </div>

      <!-- Department -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-start">
        <label for="department" class="md:col-span-1 text-gray-600 mt-2">Department</label>
        <input readonly id="department" name="department" type="text" value="OpenSource"
          class="md:col-span-3 w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-gray-600" />

          <?php if (isset($errors['department'])): ?>
          <p style="color:red;"><?php echo $errors['department']; ?></p>
          <?php endif; ?>      
        </div>

      <!--add pic-->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-start">
      <input type="file" name="image" id="fileToUpload">
       <?php if (isset($errors['image'])): ?>
          <p style="color:red;"><?php echo $errors['image']; ?></p>
          <?php endif; ?>  
      </div>

      <!-- Actions -->
      <div class="flex justify-end gap-4 pt-4">
        <button type="reset"
          class="px-6 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 transition">
          Reset
        </button>
        <button type="submit"
          class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition" name="submit" value="Submit">
          Submit
        </button>
      </div>

    </form>
  </div>
</body>
</html>