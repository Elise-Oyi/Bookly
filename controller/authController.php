<?php

// adding the database connection
include 'config/config.php';
session_start();

/* function to remove whitespace, special character
and html characters */ 
function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    // $data = mysqli_real_escape_string($data); 
    return $data;
}

// REGISTER

if(isset($_POST['submit'])){
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $pass = test_input($_POST['password']);
    $cpass = test_input($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select_users= mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' and password = '$pass'") or die('query failed');
    
    if(mysqli_num_rows($select_users) > 0){
        $message[] = 'User already exist!';
    }
    else{
       if($pass !== $cpass){
        $message[] = 'Password mismatch!';
       }
       else{
        $select_user = mysqli_query($conn, "INSERT INTO `users`(name,email,password,user_type)VALUES('$name','$email','$cpass','$user_type')") or die('query failed');
        $message[] = 'Registered successfully';
        // header('location:home.php');
        if(mysqli_num_rows($select_users) > 0){
            $row = mysqli_fetch_assoc($select_users);
    
            if($row['user_type'] == 'admin'){
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header('location:admin_page.php');
            }
            else if ($row['user_type'] == 'user'){   
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                header('location:home.php');
            }
       }
    }
}
}
//LOGIN

if(isset($_POST['login'])){
    $email = test_input($_POST['email']);
    $pass = test_input($_POST['password']);
   

    $select_users= mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' and password = '$pass'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $row = mysqli_fetch_assoc($select_users);

        if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
        }
        else if ($row['user_type'] == 'user'){   
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
        }
    }
    else{
        $message[] = 'Incorrect email or password!';
       
    }

}

?>