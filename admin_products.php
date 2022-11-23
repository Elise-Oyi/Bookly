
<?php
include 'config/config.php';
session_start();

include 'controller/adminController.php';

$admin_id = $_SESSION['admin_id'];

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
    <title class>products</title>
</head>
<body>

  <?php include 'admin_header.php' ?>
   
  <!-- product CRUD section -->
<section class="add-products">

    <h1 class="title">shop products</h1>

    <form action="" method="post" enctype="multipart/form-data">
    <h3>add product</h3>
    <input type="text" name="name" class="box" placeholder="enter product name" required>
    <input type="number" min="0" name="price" class="box" placeholder="enter product price" required>
    <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
    <input type="submit" value="add product" name="add_product" class="btn">
    </form>

</section>

<!-- Show products -->
<section class="show-products">
    <div class="box-container">

    <?php
    $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
 
    if(mysqli_num_rows($select_products)>0){
        while($fetch_products = mysqli_fetch_assoc($select_products)) {?>

            <div class="box">
                <img src="uploaded_img/<?php echo $fetch_products['image']; ?>"
                 alt="">
                <div class="name"><?php echo $fetch_products['name']; ?></div> 
                <div class="price">$<?php echo $fetch_products['price']; ?></div> 

                <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
                <a href="admin_products.php?delete=<?php echo $fetch_products['id'];?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>

            </div>

      <?php  }
    } 
    
    else{
        echo ' <p class="empty">No product has been added</p> ';
    }
    
    ?>


    </div>
</section>

<section class="edit-product-form">

   <?php
    
    if(isset($_GET['update'])){
        $update_id = $_GET['update'];

        $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');

        if(mysqli_num_rows($update_query)>0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){ ?>
                
                <form action="" method="post" enctype = "multipart/form-data">
                    <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">

                    <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">

                    <img src="uploaded_img/<?php echo $fetch_update['image'] ?>" alt="">
                    
                    <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter product name">

                    <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" class="box" required placeholder="enter product price" min="0">

                    <input type="file" name="update_image" accept="image/jpg,image/jpeg, image/png" class="box" placeholder="enter product image">

                    <input type="submit" value="update" name="update_product" class="btn">

                    <input type="reset" value="cancel" id="close-update" class="option-btn">

                </form>
            
             <?php
            }
        }
       
    } else{
        echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
    }

   ?>

</section>









  <script src="js/admin_script.js"></script>
</body>
</html>
