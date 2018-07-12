<?php

class Pack
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
            // Last ordered row
            $query = "SELECT * FROM warehouse WHERE UID = '{$UID}' ORDER BY ordered DESC LIMIT 1";

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
}