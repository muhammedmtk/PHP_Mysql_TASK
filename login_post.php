<?php
include('inc/connect.php');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

$err_s=0;
if (isset($_POST['email']) && isset($_POST['password']))
    {
$email= trim($_POST['email']);
$password = trim($_POST['password']);

if(empty($email))
    {
         $email_error = "Please enter email";
         $err_s=1;
    }
if(empty($password))
    {
        $pass_error  = "Please insert password";
        $err_s=1;
    }

    if($err_s==1)
        {
            include_once('login.php');
            exit();
        }

   
    $result = Database::getinstance()->loginUser($email,$password);

    if($result)
        {
            $_SESSION['email']=$result['email'];
            $_SESSION['user_id']=$result['id'];

            $full_name = $result['first_name'] . " " . $result['last_name'];
            $_SESSION['user_name']=$full_name;
            setcookie('full_name', $full_name, time() + 86400, "/");
            setcookie('email', $email,  time() + 86400, "/");
            setcookie('password', $password, time() + 86400, "/");
            header('location:viewAllDate.php');
            exit();
        }
        else
            {

 $user_error  = "Wrong username or password";
include_once('login.php');
exit();
            }
    }


