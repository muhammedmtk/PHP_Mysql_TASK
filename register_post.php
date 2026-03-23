<?php
include_once('inc/connect.php');
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if(isset($_POST['submit']))
{
    $errors = [];
    $db = Database::getInstance();

    // first_name
    if (empty($_POST['first_name'])) {
        $errors['first_name'] = "User Name is required";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $_POST['first_name'])) {
        $errors['first_name'] = "Username must contain only letters";
    } else {
        $first = trim($_POST['first_name']);
    }

    // last_name
    if (empty($_POST['last_name'])) {
        $errors['last_name'] = "Last Name is required";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $_POST['last_name'])) {
        $errors['last_name'] = "Lastname must contain only letters";
    } else {
        $last = trim($_POST['last_name']);
    }

    // address (>= 20 words)
    $address = trim($_POST['address'] ?? '');
    if ($address === '') {
        $errors['address'] = "Address is required";
    } elseif (str_word_count($address) < 5) {
        $errors['address'] = "Address must contain at least 5 words.";
    } else {
        $addr = $address;
    }

    // country
    if (empty($_POST['country'])) {
        $errors['country'] = "Country is required";
    } else {
        $country = $_POST['country'];
    }

    // gender
    if (empty($_POST['gender'])) {
        $errors['gender'] = "Gender is required";
    } else {
        $gender = $_POST['gender'];
    }

    // skills
    if (empty($_POST['skills']) || !is_array($_POST['skills'])) {
        $errors['skills'] = "Skills is required";
    } else {
        $skills = implode(",", $_POST['skills']);
    }

    // department
    if(empty($_POST['department'])) {
        $errors['department'] = "Department is required"; 
    } else {
        $department = $_POST['department'];
    }

    // password
    if (empty($_POST['password'])) {
        $errors['password'] = "Password is required";
    } else {
        $password = $_POST['password'];
    }

   // email
$email = trim($_POST['username'] ?? '');

if ($email === '') {
    $errors['email'] = "Email is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email";
} else {
    $sql = "SELECT id FROM users WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);          
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $errors['email'] = "This email already exists, please enter another email";
    }
}
    // image
    if(empty($_FILES['image']['name'])) {
        $errors['image'] = "image is required";  
    } else {
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = 'images/'.$file_name;
        if (!move_uploaded_file($tempname, $folder)) {
    $errors['image'] = "Upload failed (can't move file).";
}
    }

    // Insert
  if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header('Location: index1.php');
        exit;
    } else {
        $db->insertUser([
            'first_name' => $first,
            'last_name'  => $last,
            'address'    => $addr,
            'country'    => $country,
            'gender'     => $gender,
            'skills'     => $skills,
            'password'   => $password,
            'department' => $department,
            'email'      => $email,
            'image'      => $file_name
        ]);
        header('Location: login.php');
        exit;
    }
}
?>