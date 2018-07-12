 <?php

require_once 'core/init.php';

// Check if session exists
if (!isset($_SESSION['shopping_cart']))
{
    // Create message
    Session::flash('home', 'Your shopping cart is empty!');

    Redirect::to('index.php');

    exit();
}

// Creating class instances
$user = new User();
$pack = new Pack();
$IP_Data = new IP_Data();

// Check if user is logged
if ($user->is_Logged_In() === false)
{
    // Set information about login status
    Session::put("home", "!!! To pay, first you must be logged !!!<br/>");

    Redirect::to('index.php');

    exit();
}
// If user is logged in
else{

    // If user adress informations exists
    if($pack->User_Informations_Exists()){

        // Copy user adress informations from server
        $country = $pack->data()->country;
        $postal_code = $pack->data()->postal_code;
        $place = $pack->data()->place;
        $house_number = $pack->data()->house_number;
        $phone = $pack->data()->phone;
    }
    // If user adress informations don't exists get IP informations
    else{

        // Copy user ID informations from server
        $country = $IP_Data->data()->country;
        $postal_code = $IP_Data->data()->postal;
        $place = $IP_Data->data()->city;
    }
}

// Check if Pay button has been submitted
if(isset($_POST['submit'])){

    // Check if Token is correct
    if(Token::check(Input::get('token'))){

        // Copy input data
        $_SESSION['fname'] = filter_input(INPUT_POST, 'fname');
        $_SESSION['lname'] = filter_input(INPUT_POST, 'lname');
        $_SESSION['phone'] = filter_input(INPUT_POST, 'phone');
        $_SESSION['email'] = filter_input(INPUT_POST, 'email');
        $_SESSION['country'] = filter_input(INPUT_POST, 'country');
        $_SESSION['postal_code'] = filter_input(INPUT_POST, 'postal_code');
        $_SESSION['place'] = filter_input(INPUT_POST, 'place');
        $_SESSION['house_number'] = filter_input(INPUT_POST, 'house_number');

        // Copy UID
        $_SESSION['UID'] = $user->data()->UID;

        Redirect::to('RazorPay.php');
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
    <title>MAIN PAGE</title>
</head>
<body>
    <section class="main">
        <div class="container-fluid">
            <div class="col-sm-4 offset-sm-4">
                <div id="title">
                    <t>
                        <h1>Confirm user data</h1>
                    </t>
                </div>

                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="fname">First name: </label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder ="First name:" value="<?php echo $user->data()->fname ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="lname">Last name: </label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name:" value="<?php echo $user->data()->lname ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone: </label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone:" value="<?php echo isset($phone) ? $phone : '' ?>" pattern="[0-9]{9}" required title="Phone like: 883444234" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email:" value="<?php echo $user->data()->email ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="country">Country: </label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="Country:" value="<?php echo isset($country) ? $country : '' ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Postal code: </label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal code:" value="<?php echo isset($postal_code) ? $postal_code : '' ?>" required pattern="[0-9]{2}-[0-9]{3}" title="Like 44-700" />
                    </div>
                    <div class="form-group">
                        <label for="place">City: </label>
                        <input type="text" class="form-control" id="place" name="place" placeholder="City:" value="<?php echo isset($place) ? $place : ''; ?>" required  />
                    </div>
                    <div class="form-group">
                        <label for="house_number">House number: </label>
                        <input type="text" class="form-control" id="house_number" name="house_number" placeholder="House number:" value="<?php echo isset($house_number) ? $house_number : '' ?>" required />
                    </div>

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

                <div id="main_menu">
                    <a href="index.php"> Main page </a>
                </div>
                <div id="main_menu">
                    <a href="cart.php"> Shop </a>
                </div>
            </div>
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