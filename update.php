<?php

require_once 'core/init.php';

$user = new User();

// Check if logged in
if(!$user->is_Logged_In()) {
    // If not redirect into main page
    Redirect::to('index.php');
}

// Check if any $_POST data exists
if(Input::exists()) {
    // Check if Token is correct
    if(Token::check(Input::get('token'))) {

        // Check if the same e-mail
        if ($user->data()->email === $_POST['email'])
        {
            Session::put("e_email","E-mail is the same!");
        }
        else{
            $validate = new Validation();

            $validation = $validate->Change_Email_Validation($_POST);


            if($validate->Check_Flag()) {

                // Remove validation session data
                Session::Clear_Registration_Errors();

                try {

                    // Prepare query
                    $query = "UPDATE users SET email = '{$_POST['email']}' WHERE UID = '{$user->data()->UID}'";

                    // Send query into server
                    $user->update($query);

                    // Set session info
                    Session::flash('home', 'Your e-mail have been updated.');

                    // Redirect into main page
                    Redirect::to('index.php');
                }
                catch(Exception $e) {
                    die($e->getMessage());
                }
            }
        }
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
    <title>UPDATE</title>
</head>
<body>
    <section class="main">
        <div class="container-fluid">
            <div class="col-sm-4 offset-sm-4">
                <div id="title">
                    <t>
                        <h1>UPDATE EMAIL</h1>
                    </t>
                </div>
                <?php
                if(Session::exists('e_email')){
                    echo '<div class="alert alert-dismissible alert-warning">';
                    echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                    echo '<h4 class="alert-heading">Warning!</h4>';
                    echo '<p class="mb-0">'.Session::flash('e_email').'</p>';
                    echo '</div>';
                }
                ?>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="email">Enter your new email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Your old email: <?php echo escape($user->data()->email); ?>" name="email" required />
                    </div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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