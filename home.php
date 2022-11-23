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
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <title>Home page</title>
</head>
<body>
<?php include 'header.php' ?>

<section class="home">
    <div class="content">
        <h3>Hand picked books for you!</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eos adipisci quis!</p>
        <a href="shop.php" class="white-btn">Discover more</a>
    </div>
</section>

<section class="products">

    <h1 class="title">Latest products</h1>

    <div class="box-container">
        <?php
        $select_products = mysqli_query($conn,"SELECT * FROM `products` LIMIT 6") or die('query failed');
        $select_cart = mysqli_query($conn,"SELECT * FROM `cart`") or die('query failed');


        if(mysqli_num_rows($select_products)>0){
            while($fetch_products = mysqli_fetch_assoc($select_products) ){?>

            <form action="" method="post" class="box">
                <img src="uploaded_img/<?php echo $fetch_products['image'];?>" class="image" alt="">
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <div class="price">$<?php echo $fetch_products['price']; ?></div>
                <input type="number" min="0" value="1" name="product_quantity" class="qty">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                <!-- <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                <input type="hidden" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>"> -->


                <!-- <input type="submit"> -->
                <button type="submit" value="add to cart" class="btn" name="add_to_cart">add to cart</button>
            </form>
        
        <?php }
        }
        else{
            echo '<p class="empty">no products added yet!</p>';
        } 

        ?>
    </div>
</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia corporis ratione saepe sed adipisci?</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet ullam voluptatibus?</p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>

<?php include 'footer.php' ?>
    



<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>