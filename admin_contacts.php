
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
    <title>contacts</title>
</head>
<body>
  <?php include 'admin_header.php' ?>
   
<section class="messages">
    <h1 class="title">MESSAGES</h1>
    <div class="box-container">
        <?php
        $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
        if(mysqli_num_rows($select_message)>0){
            while($fetch_message = mysqli_fetch_assoc($select_message)){?>
            
            <div class="box">
                <p>user id: <span><?php echo $fetch_message['user_id']; ?></span></p>
                <p>name: <span><?php echo $fetch_message['name']; ?></span></p>
                <p>number: <span><?php echo $fetch_message['number']; ?></span></p>
                <p>email: <span><?php echo $fetch_message['email']; ?></span></p>
                <p>message: <span><?php echo $fetch_message['message']; ?></span></p>
                <a href="admin_contacts.php?delete_message=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">Delete Message</a>

            </div>
            <p></p>
            <?php }
        }
        else{
            echo '<p class="empty">you have no messages!</p>';
        }

            ?>
    </div>
</section>


  <script src="js/admin_script.js"></script>
</body>
</html>
