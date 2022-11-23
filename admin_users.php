
<?php
include 'config/config.php';
session_start();

$admin_id = $_SESSION['admin_id'];
include 'controller/adminController.php';

if(!isset($admin_id)){
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">
    <title>users</title>
</head>
<body>
  <?php include 'admin_header.php' ?>
  
  <section class="users">
  <h1 class="title">USERS</h1>
    <div class="box-container">
      
      <?php
      
      $select_user = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
      while($fetch_user = mysqli_fetch_assoc($select_user)){?>
         
         <div class="box">
          <p>user id: <span><?php echo $fetch_user['id']; ?></span></p>
          <p>username: <span><?php echo $fetch_user['name']; ?></span></p>
          <p>email: <span><?php echo $fetch_user['email']; ?></span></p>
          <p>user type: <span><?php echo $fetch_user['user_type']; ?></span></p>
          <a href="admin_users.php?delete_user=<?php echo $fetch_user['id']; ?>"
          onclick="return confirm('delete this user?');" class="delete-btn">Delete user</a>
         </div>
        <?php
      }

      ?>
    </div>
  </section>
   



  <script src="js/admin_script.js"></script>
</body>
</html>
