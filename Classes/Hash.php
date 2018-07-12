<?php

/**
 * Class supporting Hashing system
 */
class Hash {

    /**
     * Method hashing password
     * @param mixed $password - our password
     * @return string - our hashed password
     */
    public static function make_Hash_Password($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Method verify if $password == $hash
     * @param mixed $password
     * @param mixed $hash
     * @return boolean - return result in boolean form
     */
    public static function Verify_Password($password, $hash){
       return password_verify($password, $hash) ? true : false;
    }

    public static function unique(){
        return self::make_Hash_Password(uniqid());
    }
}