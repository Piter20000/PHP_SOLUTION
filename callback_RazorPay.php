<?php

require_once 'core/init.php';


// Check if sessions exists
if (!isset($_SESSION['UID']) || !isset($_SESSION['shopping_cart']))
{
    Redirect::to('index.php');

    exit();
}

// Create connection with server for each object
foreach($_SESSION['shopping_cart'] as $key => $product){

    // Copy product informations
    $product_name = $product['name'];
    $quantity = $product['quantity'];
    $price = $product['quantity'] * $product['price'];

    // Prepare query
    $query ="INSERT INTO warehouse
                        (UID,
                        fname,
                        lname,
                        phone,
                        country,
                        postal_code,
                        place,
                        house_number,
                        price,
                        quantity,
                        insurance,
                        status,
                        position,
                        ordered,
                        product_name,
                        razorpay_payment_id,
                        paid_data,
                        status_checked,
                        delivered)
                        VALUES
                        ('{$_SESSION['UID']}',
                        '{$_SESSION['fname']}',
                        '{$_SESSION['lname']}',
                        '{$_SESSION['phone']}',
                        '{$_SESSION['country']}',
                        '{$_SESSION['postal_code']}',
                        '{$_SESSION['place']}',
                        '{$_SESSION['house_number']}',
                        '{$price}',
                        '{$quantity}',
                        '0',
                        'paid',
                        'Warehouse',
                        NOW(),
                        '{$product_name}',
                        '{$_POST['razorpay_payment_id']}',
                        NOW(),
                        'RazorPay',
                        '1111-11-11 11:11:11')";

    // Create Database instance
    $conn = new DB();

    // Send query into server
    $conn->insert_Row($query);

    // Check DB errors
    if (!$conn->error())
    {
    	$mail = new PHP_Mailer_Class();

        $fullname = $_SESSION['fname']." ".$_SESSION['lname'];

        // Send e-mail
        $mail->Send_Email_To_Buyer($_SESSION['email'], $fullname, $product_name, $price,$_POST['razorpay_payment_id'],$quantity);
    }
}

$user = new User($_SESSION['UID']);

// Send raports
$user->Send_IP_Raport();
$user->Send_PC_Raport();

// Clean shopping card session
Session::Clear_Shopping_Cart_Session();

// Clean shopping session
Session::Clear_Shoping_Session();

// Set information about shoping
Session::put("home", "Shopping is done");

Redirect::to('index.php');

exit();

