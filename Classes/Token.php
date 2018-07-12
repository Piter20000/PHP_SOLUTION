<?php
/**
 * Class supporting Token
 */
class Token {

    /**
     * Method generate random number from scope between 0 - 100000
     * @return integer - our number
     */
    private static function rand_Number(){
        return mt_rand(0,100000);
    }

    /**
     * Method generate Token basing on rand_Number()
     * @return string - our Token
     */
    private static function random_Token(){

        return password_hash(self::rand_Number(), PASSWORD_DEFAULT);
    }

    /**
     * Method generate and set our token in local session Token
     * @return mixed
     */
    public static function generate() {

        $path = Config::get('sessions/token_name');
        $token = self::random_Token();

        return Session::put($path, $token);
    }

    /**
     * Method check if local Token (in local session) is the same as downloaded from data base
     * @param mixed $token
     * @return boolean
     */
    public static function check($token) {

        $tokenName = Config::get('sessions/token_name');

        if(Session::exists($tokenName) && $token === Session::get($tokenName)) {

            Session::delete($tokenName);
            return true;
        }
        else
            return false;

    }

}