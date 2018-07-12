<?php

require_once 'core/init.php';

$products_id = array();

// Check if Add to Cart button has been submitted
if(filter_input(INPUT_POST, 'add_to_cart')){

    // Check if session shopping cart exists
    if (isset($_SESSION['shopping_cart'])){

        // Check how many products are in shoping cart array
        $count = count($_SESSION['shopping_cart']);

        // Create sequantial array for matching array keys to products id's
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');

        // Check if product exists in $product_ids
        // In don't create new array
        if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
            $_SESSION['shopping_cart'][$count] = array
                (
                    'id' => filter_input(INPUT_GET, 'id'),
                    'name' => filter_input(INPUT_POST, 'name'),
                    'price' => filter_input(INPUT_POST, 'price'),
                    'quantity' => filter_input(INPUT_POST, 'quantity')
                );
        }
        // If product already exists, increase quantity
        // Match array key to id of the product being added to the cart
        else {
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){

                    // Add item quantity to the existing product in the array
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
    }
    // If session shopping cart doesn't exist, create first product with array key 0
    // Create array using submitted form data, start from key 0 and fill it with values
    else {
        $_SESSION['shopping_cart'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
}

// Check action button
if(filter_input(INPUT_GET, 'action') == 'delete'){

    // Loop through all products in the shopping cart until it matches with GET id variable
    foreach($_SESSION['shopping_cart'] as $key => $product){

        // Check if the same id
        if ($product['id'] == filter_input(INPUT_GET, 'id')){

            // Remove product from the shopping cart when it matches with the GET id
            unset($_SESSION['shopping_cart'][$key]);
        }
    }

    // Reset session array keys so they match with $product_ids numeric array
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}

//print_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <title> Shopping Cart </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/cart.css" />
</head>
<body>
    <div class="container">
        <br />
        <?php
        // Create connection with server
        $conn = new Products();

        // Copy results
        $result = $conn->data();

        foreach ($result as $product){
        ?>
        <div class="col-sm-4 col-md-3">
            <form method="post" action="cart.php?action=add&id=<?php echo $product['id']; ?>">
                <div class="products">
                    <img src="<?php echo 'img/'.$product['image']; ?>" class="img-responsive" />
                    <h4 class="text-info">
                        <?php echo $product['name']; ?>
                    </h4>
                    <h4>
                        $ <?php echo $product['price']; ?>
                    </h4>
                    <input type="number" name="quantity" class="form-control" min="1" value="1" />
                    <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                    <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                    <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-info" value="Add to Cart" />
                </div>
            </form>
        </div>
        <?php
        }
        ?>
        <div style="clear:both"></div>
        <br />
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th colspan="5">
                        <h3>Order Details</h3>
                    </th>
                </tr>
                <tr>
                    <th width="40%">Product Name</th>
                    <th width="10%">Quantity</th>
                    <th width="20%">Price</th>
                    <th width="15%">Total</th>
                    <th width="5%">Action</th>
                </tr>
                <?php
                if(!empty($_SESSION['shopping_cart'])):

                    $total = 0;

                    foreach($_SESSION['shopping_cart'] as $key => $product):
                ?>
                <tr>
                    <td>
                        <?php echo $product['name']; ?>
                    </td>
                    <td>
                        <?php echo $product['quantity']; ?>
                    </td>
                    <td>
                        $ <?php echo $product['price']; ?>
                    </td>
                    <td>
                        $ <?php echo number_format($product['quantity'] * $product['price'], 2); ?>
                    </td>
                    <td>
                        <a href="cart.php?action=delete&id=<?php echo $product['id']; ?>">
                            <div class="btn-danger">Remove</div>
                        </a>
                    </td>
                </tr>
                <?php
                        $total = $total + ($product['quantity'] * $product['price']);

                        $_SESSION['total_price'] = $total*100;

                    endforeach;
                ?>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">
                        $ <?php echo number_format($total, 2); ?>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <!-- Show checkout button only if the shopping cart is not empty -->
                    <td colspan="5">
                        <?php
                    if (isset($_SESSION['shopping_cart'])):
                        if (count($_SESSION['shopping_cart']) > 0):
                        ?>
                        <a href="http://localhost/php_solution/user_adress.php" class="button"> Pay </a>
                        <?php
                        
                        
                    endif; endif; ?>
                        <div id="main_menu">
                            <a href="index.php"> Main page </a>
                        </div>
                    </td>
                </tr>
                <?php
                endif;
                ?>
            </table>
        </div>
    </div>
</body>
</html>