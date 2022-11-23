
<?php
  if(isset($message)){
    foreach($message as $message){
        echo '
        <div class="message">
        <span>'.$message.'</span>
        <i class = "fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
        ';
    }
  }
?>

<header class="header">

   <div class="flex">
     
      <a style="font-size:2.5rem;" href="admin_page.php">Admin <span>Panel</span></a>

      <nav class="navbar">
        <a href="admin_page.php">Home</a>
        <a href="admin_products.php">Products</a>
        <a href="admin_orders.php">Orders</a>
        <a href="admin_users.php">Users</a>
        <a href="admin_contacts.php">Messages</a>
      </nav>

      <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <div class="fas fa-user" id="user-btn"></div>
      </div>

      <div class="account-box">
        <p>Username: <span><?php echo $_SESSION['admin_name']; ?></span> </p>
        <p>Email: <span><?php echo $_SESSION['admin_email']; ?></span> </p>

      </div>

   </div>

</header>