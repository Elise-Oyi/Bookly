
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
   <title>checkout</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <!-- <p> <a href="home.php">home</a> / checkout </p> -->
</div>


<section class="display-order">

  <?php
     
     $grand_total = 0;
     $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
     if(mysqli_num_rows($select_cart)>0){
        while($fetch_cart=mysqli_fetch_assoc(($select_cart))){
            $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
            $grand_total += $total_price;

            ?>
            <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '$'.$fetch_cart['price'].' x '. $fetch_cart['quantity']; ?>)</span> </p>
            <?php
        }
     }
    else{
        echo '<p class="empty">your cart is empty</p>';
     }
  ?>
   <div class="grand-total"> grand total : <span>$<?php echo $grand_total; ?></span> </div>

</section>

<section class="checkout">
 
<form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name" value="<?php echo $_SESSION['user_name']; ?>">
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email" value="<?php echo $_SESSION['user_email']; ?>">
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         <!-- <div class="inputBox">
            <span>flat number:</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. flat no.">
         </div>
         <div class="inputBox">
            <span>street :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div> -->
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" required placeholder="e.g. Accra">
         </div>
        
         <div class="inputBox">
            <span>Address :</span>
            <input type="text" name="address" required placeholder="e.g. Ghana">
         </div>
         
      </div>
      <!-- <input type="submit"> -->
      <button type="submit" value="order now" class="btn" name="order_btn">order now</button>
   </form>

</section>



</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>