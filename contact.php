
<?php
include 'config/config.php';
session_start();

$user_id = $_SESSION['user_id'];

include 'controller/homeController.php';

if(!isset($user_id)){
    header('location:login.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>contact us</h3>
   <!-- <p> <a href="home.php">home</a> / contact </p> -->
</div>

<section class="contact">

   <form action="" method="post">
      <h3>say something!</h3>
      <input type="text" name="name" required placeholder="enter your name" class="box" value="<?php echo $_SESSION['user_name']; ?>">
      <input type="email" name="email" required placeholder="enter your email" class="box" value="<?php echo $_SESSION['user_email']; ?>">
      <input type="number" name="number" required placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
      <!-- <input type="submit" value="send message" name="send" class="btn"> -->
      <button type="submit" value="send message" name="send" class="btn">Send message</button>

   </form>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>