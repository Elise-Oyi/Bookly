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
    <div class="header-2">
    <div class="flex">
     
     <a href="home.php" class="logo">Bookly <i class = "fas fa-book"></i></a>
  
        <nav class="navbar">
          <a href="home.php">Home</a>
          <a href="about.php">About</a>
          <a href="shop.php">Shop</a>
          <a href="contact.php">Contact</a>
          <a href="orders.php">Orders</a>
        </nav>
  
        <div class="icons">
          <div class="fas fa-bars" id="menu-btn"></div>
          <a href="search_page.php" class="fas fa-search"></a> 
          <div class="fas fa-user" id="user-btn"></div>
          <?php
           $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
          $cart_rows_number = mysqli_num_rows($select_cart_number); 
          ?>
          <a href="cart.php" class="fas fa-shopping-cart"><span>(<?php echo $cart_rows_number; ?>)</span></a> 
        </div>
  
        <div class="user-box">
          <p>Username: <span><?php echo $_SESSION['user_name']; ?></span> </p>
          <p>Email: <span><?php echo $_SESSION['user_email']; ?></span> </p>
          <a href="logout.php"  class="delete-btn">logout</a> 
        </div>
  
     </div>
  
    </div>

  
</header>