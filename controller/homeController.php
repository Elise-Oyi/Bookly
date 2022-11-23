
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


//---------------------ADDING PRODUCTS TO CART------------
if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    // $cart_id = $_POST['cart_id'];
    // $cart_quantity = $_POST['cart_quantity'];

    
    
   
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id='$user_id'") or die('query failed');

   
    if(mysqli_num_rows($check_cart_numbers)>0){   

        $message[] = 'item already exist in the cart, check cart to update😊';
        // mysqli_query($conn, "UPDATE `cart` SET quantity='$cart_quantity' WHERE id='cart_id'") or die('query failed');

    }
    else{
        mysqli_query($conn,"INSERT into `cart` (user_id, name, price,quantity, image) VALUES('$user_id','$product_name','$product_price','$product_quantity','$product_image')") or die('query failed');
        $message[] = 'product added to cart!';
    }
}

//---------------------SENDING MESSAGE------------
if(isset($_POST['send'])){
    $contact_name = test_input($_POST['name']);
    $contact_email = test_input($_POST['email']);
    $contact_number = $_POST['number'];
    $contact_message = test_input($_POST['message']);

    $select_number = mysqli_query($conn, "SELECT * FROM `message` where name='$contact_name' AND email='$contact_email' AND message='$contact_message'") or die('query failed');

    if(mysqli_num_rows($select_number)>0){
        $message[] = 'message already sent';
    }
    else{
        mysqli_query($conn, "INSERT INTO `message`(user_id,name,email,number,message)VALUES('$user_id','$contact_name','$contact_email','$contact_number','$contact_message')") or die('query failed');
        $message[] = 'message sent successfully!';
    }
}

//-----------------UPDATING CART-------------------------
if(isset($_GET['delete_cart'])){
    $delete_cart_id = $_GET['delete_cart'];

    mysqli_query($conn, "DELETE FROM `cart` WHERE id='$delete_cart_id'") or die('query failed');
    header('location:cart.php');
}

if(isset($_POST['update_cart'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];

    mysqli_query($conn, "UPDATE `cart` SET quantity='$cart_quantity' WHERE id='$cart_id'") or die('query failed');
    header('location:cart.php');
}


//------------------------DELETING ALL PRODUCTS FROM CART------------------
if(isset($_GET['delete_all'])){
    $delete_all_id = $_GET['delete_all'];

    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id='$user_id'") or die('query failed');
    header('location:cart.php');
}


//-------------------------CHECK OUT PAGE--------------------------
if(isset($_POST['order_btn'])){
    $checkout_name = test_input($_POST['name']);
    $checkout_number= $_POST['number'];
    $checkout_email= $_POST['email'];
    $checkout_method= $_POST['method'];
    $checkout_address= $_POST['city'].', '.$_POST['address'];
    $placed_on = date('D-M-Y');

    $cart_total = 0;
    $cart_products[] = ''; 

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
    if(mysqli_num_rows($cart_query)>0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){

            $cart_products[] = $cart_item['name'].'('.$cart_item['quantity'].')';
            $sub_total  = ($cart_item['price'] * $cart_item['quantity'] );
            
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ',$cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$checkout_name' AND number = '$checkout_number' AND email = '$checkout_email' AND method = '$checkout_method' AND address = '$checkout_address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if($cart_total == 0){
        $message[] = 'your cart is empty';
    }
    else{
        if(mysqli_num_rows($order_query)){
            $message[] = 'order already placed!'; 
        }
        else{
            mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$checkout_name', '$checkout_number', '$checkout_email', '$checkout_method', '$checkout_address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');

            $message[] = 'order placed successfully!';
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        }
    }




}

// --------------------SEARCH PAGE-----------------------
if(isset($_POST['add_to_cart_shop'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    $product_id = $_POST['product_id'];

 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
        mysqli_query($conn, "UPDATE `cart` SET quantity='$product_quantity' WHERE id='product_id'") or die('query failed');

       $message[] = 'already added to cart!';
    }else{
       mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart!';
    }
 
 };
 



?>