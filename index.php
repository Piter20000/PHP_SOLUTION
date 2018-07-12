<?php
require_once 'core/init.php';
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="css/boostrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans" rel="stylesheet" />
    <title>MAIN PAGE</title>
</head>
<body>
    <section class="main">
        <div class="container-fluid">
            <div class="col-sm">
                <div id="title"><t><h1>MAIN PAGE</h1></t></div>
                <?php
                if(Session::exists('home')){
                echo '<div class="alert alert-dismissible alert-warning">';
                echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                echo '<h4 class="alert-heading">Warning!</h4>';
                echo '<p class="mb-0">'.Session::flash('home').'</p>';
                echo '</div>';
                }
                $user = new User();
                if($user->is_Logged_In()) {
                ?>
                <h2>Logged as:<a href="profile.php?UID=<?php echo escape($user->data()->UID);?>"> <?php echo escape($user->data()->fullname); ?></a><br /></h2>
                <a href="update.php"class="btn btn-outline-secondary">Update Profile</a>
                <a href="changepassword.php"class="btn btn-outline-success">Change Password</a>
                <a href="logout.php"class="btn btn-outline-danger">Log out</a>
                <a href="cart.php"class="btn btn-outline-warning">Shop</a>
                <a href="user_adress.php"class="btn btn-outline-info">Shopping cart</a>
                <?php
                }
                else{ 
                ?>
                <a href="login.php"class="btn btn-outline-light">Login</a>
                <a href="register.php"class="btn btn-outline-dark">Register</a>
                <a href="cart.php"class="btn btn-outline-warning">Shop</a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <a href="graph.php" class="btn btn-outline-primary">Graphs</a>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
 <footer class="container-fluid text-center navbar-fixed-bottom">
  <p>Piotr Murdzia - example page</p>
</footer>
</body>
</html>

