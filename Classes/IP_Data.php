<?php

class IP_Data
{
    private $_db; // Data base connection
    private $_data; // Data from data base
    private $_session_Name; // Session name
    private $_User_Informations_Exists = false; // If exists user adress informations

    /**
     * Class constructor
     */
    public function __construct(){

        // Session name
        $this->_session_Name = Config::get('sessions/session_name');

        // Check if session exists
        if(Session::exists($this->_session_Name)){

            // Copy user UID
            $UID = Session::get($this->_session_Name);

            // Find user by UID
            if($this->find($UID)){

                // Set flag as true
                $this->_User_Informations_Exists = true;
            }
            else
                // Set flag as false
                $this->_User_Informations_Exists = false;
        }
        else
            // Set flag as false
            $this->_User_Informations_Exists = false;
    }

    /**
     * Method check in warehouse if exists adress informations about user
     * @param mixed $UID - user ID
     * @return boolean - result
     */
    public function find($UID){

        // Create connection with data base
        $this->_db = DB::get_Instance();

        // Prepare query
        $query = "SELECT * FROM ip_data WHERE UID = '{$UID}' LIMIT 1";

        // Send query into server
        $this->_db->Get_Rows_As_Objects($query);

        // Count results
        if($this->_db->count() > 0){

            // Create instance data from server
            $this->_data = $this->_db->first();

            return true;
        }
        else
            return false;
    }

    /**
     * Method check if exists user adress informations
     * @return boolean - result
     */
    public function User_Informations_Exists(){
        return $this->_User_Informations_Exists;
    }

    /**
     * Method return bunch of informations from data base
     * @return mixed - our data
     */
    public function data(){
        return $this->_data;
    }

    /**
     * Method get IP data from web
     * @return mixed
     */
    public static function Get_IP_Data(){

        $data = json_decode(file_get_contents('https://ipapi.co/json/'));

        return $data;
    }

}