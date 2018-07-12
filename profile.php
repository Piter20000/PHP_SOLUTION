<?php

require_once 'core/init.php';

if(!isset($_GET["UID"]))
    Redirect::to('index.php');

else {

    $UID = $_GET["UID"];

    $user = new User($UID);

    if(!$user->exists()) {
        Redirect::to(404);
    }
    else {
        $data = $user->data();

        // Create connection with Database
        $conn = new DB();

        // Prepare query
        $query = "Select * FROM warehouse WHERE UID = '{$user->data()->UID}' ORDER BY ordered";

        // Send query into server
        $conn->get_Rows($query);

        $warehouse = $conn->results();
    }
}

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="css/boostrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans" rel="stylesheet" />
    <title>Profile</title>
</head>
<body>
    <section class="main">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div id="title">
                    <t>
                        <h1>Profile panel</h1>
                    </t>
                </div>
                <h2>
                    <?php echo '<span style="color:red">'.escape($data->fullname).'</span>'; ?>
                </h2>
                <h5>
                        Nick:  <?php echo '<span style="color:#b6ff00">'.escape($data->nick).'</span>'; ?>
                        <br />
                        First name: <?php echo '<span style="color:#b6ff00">'.escape($data->fname).'</span>'; ?>
                        <br />
                        Last name: <?php echo '<span style="color:#b6ff00">'.escape($data->lname).'</span>'; ?>
                        <br />
                        E-mail: <?php echo '<span style="color:#b6ff00">'.escape($data->email).'</span>'; ?>
                        <br />
                        Registered: <?php echo '<span style="color:#b6ff00">'.escape($data->registrationtime).'</span>'; ?>
                        <br />
                </h5>
                <h4>Your shoppigs:</h4>
                <br /> 
                <?php

                    $A = "<span style='color: black';>";
                    $B = "</span>";

                    foreach ($warehouse as $product)
                    {
                        $name = $product['product_name'];
                        $quantity = $product['quantity'];
                        $price = $product['price'];

                        echo '<div class="alert alert-success">';
                        echo "{$A}Product name: {$B}{$name} ";
                        echo "{$A}quantity: {$B}{$quantity} ";
                        echo "{$A}price: $ {$B}{$price}";
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
        <div id="main_menu">
            <a href="index.php"> Main page </a>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <footer class="container-fluid text-center navbar-fixed-bottom">
        <p>Piotr Murdzia - example page</p>
    </footer>
</body>
</html>