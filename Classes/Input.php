<?php
/**
 * Class supporting $_POST & $_GET variables
 */
class Input {

    /**
     * Method check if $_POST or $_GET isset
     * @param mixed $type - post/get
     * @return boolean - result
     */
    public static function exists($type = 'POST'){
        switch($type){
            case 'POST':
            case 'post':
                return (!empty($_POST)) ? true : false;
            case 'GET':
            case 'get':
                return (!empty($_GET)) ? true : false;
            default:
                return false;
        }
    }

    /**
     * Method return value from $_POST or $_GET
     * @param mixed $item - name
     * @return mixed - value
     */
    public static function get($item){
        if(isset($_POST[$item]))
            return $_POST[$item];
        else if(isset($_GET[$item]))
            return $_GET[$item];
        else return '';
    }
}