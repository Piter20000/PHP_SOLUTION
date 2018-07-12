<?php

require_once 'core/init.php';

// Check if $_POST is inicializated
if (Input::exists()){
    // Check if Token is correct
    if(Token::check(Input::get('token'))){

        // Create instance of Validation
        $Validate = new Validation();

        // Initialization instance of Validation
        $Validation = $Validate->Validate_Data($_POST);

        // If validate ok
        if ($Validate->Check_Flag())
        {
            // Create instance of user
            $User = new User();

            try
            {
                // Create new user
                $User->create_New_User($_POST);

                // Create welcom session
                Session::flash('home', 'Welcome ' . $_POST['nick'] . '! Your account has been registered. You may now log in.');

                // Clear registration errors
                Session::Clear_Registration_Errors();

                // Clear registration memory
                Session::Clear_Registration_Memory();

                // Redirect into main page
                Redirect::to('index.php');
            }
            catch (Exception $exception)
            {
                throw new Exception ("Error during creating new user");
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
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <title>Register page</title>
</head>
<body>
    <section class="main">
        <div class="container-fluid">
            <div class="col-sm-4 offset-sm-4">
                <div id="title">
                    <t>
                        <h1>Register Panel</h1>
                    </t>
                </div>
                <?php

                if(isset($_SESSION['e_nick']))
                    echo '<div class="alert alert-warning"><strong>Warning!</strong> '.Session::flash('e_nick').'</div>';
                if(isset($_SESSION['e_fname']))
                    echo '<div class="alert alert-warning"><strong>Warning!</strong> '.Session::flash('e_fname').'</div>';
                if(isset($_SESSION['e_lname']))
                    echo '<div class="alert alert-warning"><strong>Warning!</strong> '.Session::flash('e_lname').'</div>';
                if(isset($_SESSION['e_email']))
                    echo '<div class="alert alert-warning"><strong>Warning!</strong> '.Session::flash('e_email').'</div>';
                if(isset($_SESSION['e_password']))
                    echo '<div class="alert alert-warning"><strong>Warning!</strong> '.Session::flash('e_password').'</div>';
                if(isset($_SESSION['e_checkbox']))
                    echo '<div class="alert alert-warning"><strong>Warning!</strong> '.Session::flash('e_checkbox').'</div>';

                ?>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="nick">Nick: </label>
                        <input type="text" class="form-control" id="nick" name="nick" minlength="8" placeholder="Enter your nick:" value="<?php Session::show('w_nick'); ?>" required title="Enter your nick" />
                    </div>
                    <div class="form-group">
                        <label for="e-mail">Email: </label>
                        <input type="email" class="form-control" id="e-mail" name="e-mail" placeholder="Enter your email:" value="<?php Session::show('w_email'); ?>" required title="Enter your email" />
                    </div>
                    <div class="form-group">
                        <label for="first_Name">First name: </label>
                        <input type="text" class="form-control" id="first_Name" name="first_Name" placeholder="Enter your first name:" maxlength="50" value="<?php Session::show('w_fname'); ?>" required title="Enter your first name" />
                    </div>
                    <div class="form-group">
                        <label for="last_Name">Last name: </label>
                        <input type="text" class="form-control" id="last_Name" name="last_Name" placeholder="Enter your last name:" maxlength="50" value="<?php Session::show('w_lname'); ?>" required title="Enter your last name" />
                    </div>
                    <div class="form-group">
                        <label for="password1">Password: </label>
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Password:" minlength="8" required title="8 characters minimum, maximum 50" />
                    </div>
                    <div class="form-group">
                        <label for="password2">Repeat password: </label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat password:" minlength="8" required title="8 characters minimum, maximum 50" />
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" id="checkbox" name="checkbox" <?php Session::show('w_checkbox'); ?> required title="You must accept our rules" /> Accept rules
                        </label>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6Ld7VU0UAAAAAH4e2HbGnFrpdTEAIVYgHvB_cEhG"></div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <button type="submit" name="submit" class="btn btn-primary">Register</button>
                </form>

                <div id="main_menu">
                    <a href="index.php"> Main page </a>
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