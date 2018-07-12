<?php
/**
 * Class supporting Cookies
 */
class Cookie {

    /**
     * Method check if Cookie exists
     * @param mixed $name - our cookie name
     * @return boolean - result
     */
    public static function exists ($name){
        return (isset($_COOKIE[$name])) ? true : false;
    }

    /**
     * Method return value from Cookie
     * @param mixed $name - our cookie name
     * @return mixed - result
     */
    public static function get ($name){
        return $_COOKIE[$name];
    }

    /**
     * Method create local Cookie
     * @param mixed $name - Cookie name
     * @param mixed $value - value
     * @param mixed $expiry - how long keep Cookie
     * @return boolean - result
     */
    public static function put ($name, $value, $expiry){
        if(setcookie($name, $value, time() + $expiry, '/')){
            return true;
        }
        return false;
    }

    /**
     * Method delete local Cookie
     * @param mixed $name - Cookie name
     */
    public static function delete ($name){
        self::put($name, '', time()-1);
    }
}