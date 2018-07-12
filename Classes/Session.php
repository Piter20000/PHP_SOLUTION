<?php

/**
 * Class supporting Session
 */
class Session {

    /**
     * Method check if Session exists
     * @param mixed $name - session name
     * @return boolean - result
     */
    public static function exists($name){
        return(isset($_SESSION[$name])) ? true : false;
    }

    /**
     * Method create new Session
     * @param mixed $name - new Session name
     * @param mixed $value - new Session value
     * @return mixed - return created Seesion
     */
    public static function put($name, $value){
        return $_SESSION[$name] = $value;
    }

    /**
     * Method return Session's value
     * @param mixed $name - Session name
     * @return mixed - value
     */
    public static function get($name){
        return $_SESSION[$name];
    }

    /**
     * Method delete indicated Session
     * @param mixed $name - Session name
     */
    public static function delete($name){
        if(self::exists($name)){
            unset($_SESSION[$name]);
        }
    }

    /**
     * Method return value from indicated Session and removes it, or create new Session
     * @param mixed $name - Session name
     * @param mixed $string - Session value
     * @return mixed - result
     */
    public static function flash($name, $string = 'null'){

        // If exists
        if(self::exists($name)){

            // Copy value
            $session = self::get($name);

            // Remove Session
            self::delete($name);

            // Return session value
            return $session;
        }
        // Else create new Session
        else{

            self::put($name,$string);
        }

    }

    /**
     * Method copy value from Session then delete Session and return value
     * @param mixed $name - Session name
     * @return mixed - result
     */
    public static function show_And_Delete($name){
        $variable = self::get($name);
        self::delete($name);
        return $variable;
    }

    /**
     * Method check if Session exists, if is schow value
     * @param mixed $name - Session name
     */
    public static function show($name){

        if(self::exists($name)){

            echo self::get($name);
        }
    }

    /**
     * Method check if session exists
     * If true show value
     * Then delete session
     * @param mixed $name - if exists return session value, else return nothing
     */
    public static function If_Exists_Show_And_Delete($name){

        if (self::exists($name))
            echo '<div class="error_message">'.self::show_And_Delete($name).'</div>';
    }

    #region Clear sessions

    /**
     * Method remove all registration errors
     */
    public static function Clear_Registration_Errors(){

        self::delete('e_nick');
        self::delete('e_fname');
        self::delete('e_lname');
        self::delete('e_email');
        self::delete('e_password');
        self::delete('e_password1');
        self::delete('e_checkbox');
    }

    /**
     * Method remove all registration memory
     */
    public static function Clear_Registration_Memory(){

        self::delete('w_nick');
        self::delete('w_fname');
        self::delete('w_lname');
        self::delete('w_email');
        self::delete('w_checkbox');
    }

    /**
     * Method clear Facebook login session
     */
    public static function Clear_FB_Login_Session(){
        self::delete('Fuid');
        self::delete('fullname');
        self::delete('fname');
        self::delete('lname');
        self::delete('email');
        self::delete('img');
    }

    /**
     * Method clear Google login session
     */
    public static function Clear_Google_Login_Session(){
        self::delete('Guid');
        self::delete('email');
        self::delete('fname');
        self::delete('lname');
        self::delete('fullname');
        self::delete('picture');

    }

    /**
     * Method clear Shopping Cart session
     */
    public static function Clear_Shopping_Cart_Session(){
        self::delete('shopping_cart');
    }

    /**
     * Method clear shopping session
     */
    public static function Clear_Shoping_Session(){
        self::delete('total_price');
        self::delete('fname');
        self::delete('lname');
        self::delete('phone');
        self::delete('email');
        self::delete('country');
        self::delete('postal_code');
        self::delete('place');
        self::delete('house_number');
        self::delete('UID');
    }

    #endregion
}