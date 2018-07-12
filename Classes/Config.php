<?php

/**
 * Class supporting $GLOBALS variabules
 */
class Config {

    /**
     * Method return informations from $GLOBALS variabules
     * @param mixed $path - path to variables
     * @return mixed - if exists returne value, else return false
     */
    public static function get($path = null) {
        if ($path){
            $config = $GLOBALS['config'];
            $path = explode('/', $path);

            foreach($path as $bit) {
                if(isset($config[$bit])) {
                    $config = $config[$bit];
                }
            }
            return $config;
        }
        return false;
    }
}