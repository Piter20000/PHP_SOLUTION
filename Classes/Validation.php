<?php

/**
 * Validation Class
 */
class Validation {

    private $_db; // Data base connection
    private $_flag = true;
    private $_max = 50; // Max chars in word
    private $_min = 8; // Min chars in word

    /**
     * Class constructor
     */
    public function __construct(){

        // Create connection with data base
        $this->_db = DB::get_Instance();
    }

    #region ### Validation ###

    /**
     * Main register Validation method
     * @param mixed $sorce - results
     */
    public function Validate_Data($sorce){

        // Create connection with database
        $this->_db = DB::get_Instance();

        // Set validation flag as true
        $this->_flag = true;

        ### Nick Validation ###

        self::Nick_Register_Validation($sorce);

        ### E-mail Validation ###

        self::Email_Register_Validation($sorce);

        ### Password Validation ###

        self::Password_Register_Validation($sorce);

        ### Check checkbox ###

        self::check_Check_Box($sorce);

        ### Check reCAPTCHA ###

        self::check_ReCAPTCHA($sorce);

        ### Check first name ###
        self::FName_Register_Validation($sorce);

        ### Check last name ###
        self::LName_Register_Validation($sorce);
    }

    /**
     *  Main login Validation method
     * @param mixed $sorce
     */
    public function Login_Validation($sorce){

        // Set validation flag as true
        $this->_flag = true;

        // Validate $username
        self::Username_Login_Validation($sorce);

        // Validate $username
        self::Password_Login_Validation($sorce);
    }

    /**
     *  Method check if e-mail is correct
     * @param mixed $sorce
     */
    public function Change_Email_Validation($sorce){

        $email = $sorce['email'];

        if ($email == '')
        {
            $this->_flag = false;

            Session::put('e_email', 'Empty e-mail!');
        }

        else if(self::check_Email($email)){

            $this->_flag = false;

            Session::put('e_email', 'Incorrect e-mail!');
        }

        else if(self::check_If_Email_Exists($email)){

            $this->_flag = false;

            Session::put('e_email', 'E-mail is the same!');
        }
    }

    /**
     * Method check:
     * If we enter old password
     * Check new password
     * @param mixed $sorce
     */
    public function Change_Password_Validation($sorce){

        if (empty($sorce['current_password']))
        {
        	$this->_flag = false;

            Session::put('e_password', 'You must enter your old password');
        }
        if($this->_flag){

            // Copy send values into local instances
            $password1 = $sorce['password1'];
            $password2 = $sorce['password2'];

            // Check if password is too long
            if(self::check_Max($password1)){

                $this->_flag = false;

                Session::put('e_password1', 'Your new password is too long, max '.$this->_max.' chars!');
            }

            // Check if password is too short
            else if(self::check_Min($password1)){

                $this->_flag = false;

                Session::put('e_password1', 'Your new password is too short , min '.$this->_min.' chars!');
            }

            // Check if passwords are the same
            else if(self::check_If_The_Same_Passwords($password1,$password2)){

                $this->_flag = false;

                Session::put('e_password1', 'Different new passwords!');
            }
        }
    }

        #region ### Validation data methods ###

        /**
         * Summary of Nick_Validation
         * @param mixed $sorce
         */
        private function Nick_Register_Validation($sorce){

            // Create local instance of nick
            $nick = $sorce['nick'];

            // Check if nick is null or empty
            if(self::check_Null_Or_Empty($nick)){

                $this->_flag = false;

                Session::put('e_nick', 'Empty box!');
            }

            // Check min chars in nick
            else if(self::check_Min($nick)){

                $this->_flag = false;

                Session::put('e_nick', 'Your nick is too short, min '.$this->_min.' chars!');
            }

            // Check max chars in nick
            else if(self::check_Max($nick)){

                $this->_flag = false;

                Session::put('e_nick', 'Your nick is too long, max '.$this->_max.' chars!');
            }

            // Check if nick contain only alphanumeric chars
            else if(!self::check_If_Alphanumeric($nick)){

                $this->_flag = false;

                Session::put('e_nick', 'Only alphanumeric letters are allowed!');
            }
            // Check if nick is currently occupied
            else if(Self::check_If_Nick_Exists($nick)){

                $this->_flag = false;

                Session::put('e_nick', 'Nick "'.$nick.'" is occupied!');
            }
            else
                Session::put('w_nick', $nick);
        }

        /**
         * Summary of Email_Validation
         * @param mixed $sorce
         */
        private function Email_Register_Validation($sorce){

            $email = $sorce['e-mail'];
            if ($email == '')
            {
            	$this->_flag = false;

                Session::put('e_email', 'Empty e-mail!');
            }

            else if(self::check_Email($email)){

                $this->_flag = false;

                Session::put('e_email', 'Incorrect e-mail!');
            }

            else if(self::check_If_Email_Exists($email)){

                $this->_flag = false;

                Session::put('e_email', 'E-mail is occupied!');
            }

            else Session::put('w_email', $email);
        }

        /**
         * Summary of Password_Validation
         * @param mixed $sorce
         */
        private function Password_Register_Validation($sorce){

            // Copy send values into local instances
            $password1 = $sorce['password1'];
            $password2 = $sorce['password2'];

            // Check if password is too long
            if(self::check_Max($password1)){

                $this->_flag = false;

                Session::put('e_password', 'Your password is too long, max '.$this->_max.' chars!');
            }

            // Check if password is too short
            else if(self::check_Min($password1)){

                $this->_flag = false;

                Session::put('e_password', 'Your password is too short , min '.$this->_min.' chars!');
            }

            // Check if passwords are the same
            else if(self::check_If_The_Same_Passwords($password1,$password2)){

                $this->_flag = false;

                Session::put('e_password', 'Different passwords!');
            }
        }

        /**
         * Summary of FName_Validation
         * @param mixed $sorce
         */
        private function FName_Register_Validation($sorce){

            // Create local instance of nick
            $fname = $sorce['first_Name'];

            // Check if nick is null or empty
            if(self::check_Null_Or_Empty($fname)){

                $this->_flag = false;

                Session::put('e_fname', 'Empty box!');
            }
            // Check max chars in nick
            else if(self::check_Max($fname)){

                $this->_flag = false;

                Session::put('e_fname', 'Your first name is too long, max '.$this->_max.' chars!');
            }
            // Check if nick contain only alphanumeric chars
            else if(!self::check_If_Alphanumeric($fname)){

                $this->_flag = false;

                Session::put('e_fname', 'Only alphanumeric letters are allowed!');
            }
            else
                Session::put('w_fname', $fname);
        }

        /**
         * Summary of LName_Validation
         * @param mixed $sorce
         */
        private function LName_Register_Validation($sorce){

            // Create local instance of nick
            $lname = $sorce['last_Name'];

            // Check if nick is null or empty
            if(self::check_Null_Or_Empty($lname)){

                $this->_flag = false;

                Session::put('e_lname', 'Empty box!');
            }
            // Check max chars in nick
            else if(self::check_Max($lname)){

                $this->_flag = false;

                Session::put('e_lname', 'Your last name is too long, max '.$this->_max.' chars!');
            }

            // Check if nick contain only alphanumeric chars
            else if(!self::check_If_Alphanumeric($lname)){

                $this->_flag = false;

                Session::put('e_lname', 'Only alphanumeric letters are allowed!');
            }
            else
                Session::put('w_lname', $lname);
        }

        /**
         * Summary of Username_Login_Validation
         * @param mixed $sorce
         */
        public function Username_Login_Validation($sorce){

            // Create local instance of nick
            $username = $sorce['username'];

            // Validate $username as e-mail
            if (self::check_Email($username))
            {
                $this->_flag = false;

                Session::put('e_login', 'Incorrect login!');
            }
        }

        /**
         * Summary of Password_Login_Validation
         * @param mixed $sorce
         */
        public function Password_Login_Validation($sorce){

            $password = $sorce['password'];

            if (self::check_Null_Or_Empty($password))
            {
            	$this->_flag = false;

                Session::put('e_login', 'Incorrect password!');
            }
        }

        #endregion

    #endregion

    #region ### Common functions ###

    /**
     * Method check if word has more than 50 chars
     * @param mixed $word - our word
     * @return boolean - result
     */
    private function check_Max($word){
        return (strlen($word) > $this->_max) ? true : false;
    }

    /**
     * Method check if word has at list 8 chars
     * @param mixed $word - our word
     * @return boolean - result
     */
    private function check_Min($word){
        return (strlen($word) < $this->_min) ? true : false;
    }

    /**
     * Method check if word is null or empty
     * @param mixed $word - our word
     * @return boolean - result
     */
    private function check_Null_Or_Empty($word){
        return ($word == '' || $word == null) ? true : false;
    }

    /**
     * Method check if word is alphanumeric
     * @param mixed $word - our word
     * @return boolean - result
     */
    private function check_If_Alphanumeric($word){
        return ctype_alnum($word) ? true : false;
    }

    #endregion

    #region ### Nick ###

    /**
     * Method check if Nick already exists
     * @param mixed $nick - our nick
     * @return boolean - result
     */
    private function check_If_Nick_Exists($nick){

        // Prepare query
        $query = "SELECT * FROM users WHERE nick = ?";

        // Send query into server
        $this->_db->get_Rows($query, array($nick));

        // Return result of query
        // True - if find
        // False - in dont
        return ($this->_db->count() > 0 ) ? true : false;
    }

    #endregion

    #region ### Email ###

    /**
     * Method check if the variable $email is a valid email address
     * @param mixed $email - our e-mail
     * @return boolean result
     */
    private function email_Check_Validation($email){
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    /**
     * Method check if e-mail is correct
     * @param mixed $email - our e-mail
     * @return boolean - result
     */
    private function check_Email($email){

        //Remove all illegal characters from an e-mail adress
        $email_B = filter_var($email, FILTER_SANITIZE_EMAIL);

        $Validate = self::email_Check_Validation($email_B);

        return (($Validate == false) || ($email != $email_B)) ? true : false;
    }

    /**
     * Method check if e-mail already exists
     * @param mixed $email - our email
     * @return boolean - result
     */
    private function check_If_Email_Exists($email){

        // Prepare query
        $query = "SELECT * FROM `users` WHERE (Fuid = '' AND Guid = '' AND email = '{$email}')";

        // Send query into server
        $this->_db->get_Rows($query);

        // Return result of query
        // True - if find
        // False - in dont
        return ($this->_db->count() > 0 ) ? true : false;
    }

    #endregion

    #region ### Password ###

    /**
     * Method check if passed passwords are the same
     * @param mixed $pass1 - 1st password
     * @param mixed $pass2 - 2nd password
     * @return boolean - result
     */
    private function check_If_The_Same_Passwords($pass1, $pass2){
        return ($pass1 != $pass2) ? true : false;
    }

    #endregion

    #region ### FB / G-Mail ID ###

    private function check_ID($id){

        $query = "SELECT FROM users WHERE oauth_uid = ?";
        $data = $this->_db->get_Row($query, $id);

        return ($this->_db->count_Rows($data) > 0) ? true : false;
    }

    #endregion

    #region  ### re-reCAPTCHA ###

    /**
     * Method check if reCAPTCHA is checked
     * @param mixed $sorce - value sended in array form (there in $_POST version)
     */
    private function check_ReCAPTCHA($sorce){

        // Secret key from server
        $secret_key = "6Ld7VU0UAAAAADcTAMHGHW4cU_B2Ryo8-6FC6qdn";

        // Send query into server
        $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$sorce['g-recaptcha-response']);

        // Decode jquery code
        $answer = json_decode($check);

        // Check answer
        if ($answer->success==false){

            $this->_flag = false;

			Session::put('e_reCAPTCHA','Proof you are not a robot');
		}
    }

    #endregion

    #region ### Check Box ###

    /**
     * Method check if we mark Check Box
     * @param mixed $sorce - value sended in array form (there in $_POST version)
     */
    private function check_Check_Box($sorce){

        if (!isset($sorce['checkbox'])){

            $this->_flag = false;

            Session::put('e_checkbox','You must accept rules');

            Session::delete('w_checkbox');
        }

        #Save our choice
        else Session::put('w_checkbox',"checked");
    }

    #endregion

    #region Check if accout exists

    /**
     * Method check if in our database exists username
     * @param mixed $query
     * @return boolean - return true if exists else false
     */
    private function Check_If_User_Exists($query){

        // Send query into server
        $this->_db->get_Row($query);

        // Return result of query
        // True - if find
        // False - in dont
        return ($this->_db->count() > 0 ) ? true : false;
    }

    #endregion

    #region Flag check

    /**
     * Method return result of validation
     * @return boolean
     */
    public function Check_Flag(){
        return $this->_flag;
    }

    #endregion

}