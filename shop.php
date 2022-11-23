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
    <title>shop</title>
   
</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
    <h3>Shop now!</h3>
    <!-- <p> <a href="home.php">home</a> / shop </p> -->
</div>

<section class="products">
    <h1 class="title">latest products</h1>
    <div class="box-container">
    
    <?php
    $select_products =mysqli_query($conn,"SELECT * FROM `products`") or die('query failed');
    if(mysqli_num_rows($select_products)>0){
        while($fetch_products = mysqli_fetch_assoc($select_products)){?>

          <form action="" method="post" class="box">

            <img src="uploaded_img/<?php echo $fetch_products['image'] ?>" class="image" alt="">
            <div class="name"><?php echo $fetch_products['name'] ?></div>
            <div class="price">$<?php echo $fetch_products['price'] ?></div>
            <input type="number" min="1" name="product_quantity" value="1" class="qty">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
            <!-- <input type="submit" value="add to cart" name="add_to_cart" class="btn"> -->
            <button type="submit" value="add to cart" class="btn" name="add_to_cart">add to cart</button>


            </form>
          
        <?php }
    }
    
    ?>
    </div>
</section>

<?php include 'footer.php' ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>