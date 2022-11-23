<?php

/* function to remove whitespace, special character
and html characters */ 
function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    // $data = mysqli_real_escape_string($data); 
    return $data;
}

// --------------------FOR ADMIN_PRODUCT-----------------------

if(isset($_POST['add_product'])){
    $name = test_input($_POST['name']);
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;

    $select_product_name = mysqli_query($conn,"SELECT name FROM `products` WHERE name = '$name'") or die('query failed');
  
    if(mysqli_num_rows($select_product_name)>0){
        $message[] = 'Product name already exist';
    }
    else{
       $add_product_query = mysqli_query($conn,"INSERT into `products`(name,price,image) VALUES('$name','$price','$image')") or die('query failed');

       if($add_product_query){
            if($image_size>2000000){
                $message[] = 'Image size too large';
            }
            else{
                move_uploaded_file($image_tmp_name,$image_folder);
                $message[] = 'product added successfully!';
        
            }
       }
       else{
        $message[] = 'product could not be added';
       }
    }
}

// Deleting products
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    // displaying image after update is done
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = $delete_id") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_img/'.$fetch_delete_image['image']);

    // deleting image from database
    mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_products.php');
}

// Updating products
if(isset($_POST['update_product'])){

    $update_p_id = $_POST['update_p_id'];
    $update_name = test_input($_POST['update_name']);
    $update_price = test_input($_POST['update_price']);
    // $update_image = $_POST['update_image'];

     mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_folder = 'uploaded_img/'.$update_image;
    $update_old_image = $_POST['update_old_image'];

    if(!empty($update_image)){
        if($update_image_size>2000000){
            $message[] = "Image size too large";
        }
        else{
            mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
            move_uploaded_file($update_image_tmp_name,$update_folder);
            unlink('uploaded_img/'.$update_old_image);
        }
    }
    header('location:admin_products.php');

}


// --------------------FOR ADMIN_ORDERS-----------------------
if(isset($_POST['update_payment'])){
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];

    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
    $message[] = 'order status updated succesfully';
}

//For deleting an order product
if(isset($_GET['delete_orders'])){
    $delete_id = $_GET['delete_orders'];
    mysqli_query($conn, "DELETE FROM `orders` where id = '$delete_id'") or die('query failed');
    $message[] = 'order status deleted succesfully';
    header('location:admin_orders.php');
}

// --------------------FOR ADMIN_USERS-----------------------

//For deleting users
if(isset($_GET['delete_user'])){
    $delete_user_id = $_GET['delete_user'];

    mysqli_query($conn, "DELETE FROM `users` WHERE id=$delete_user_id") or die('query failed');
    header('location:admin_users.php');
}

// --------------------FOR ADMIN_CONTACTS--------------------`
if(isset($_GET['delete_message'])){
    $delete_message_id = $_GET['delete_message'];

    mysqli_query($conn, "DELETE FROM `message` WHERE id='$delete_message_id' ") or die('query failed');
    header('location:admin_contacts.php');

    // mysqli_query($conn, "DELETE FROM `message` WHERE id=$delete_message_id") or die('query failed');
    // header('location:admin_contacts.php');
}










?>