<?php

class Products{

    private $_db; // Data base connection
    private $_data; // Data from data base

    /**
     * Class constructor
     */
    public function __construct(){

        self::find();
    }

    /**
     * Method load products from server
     */
    public function find(){

        // Create connection with server
        $conn = new DB();

        // Prepare query
        $query = "SELECT * FROM products order by id ASC";

        // Send query into server
        $conn->get_Rows($query);

        // Copy results
        $this->_data = $conn->results();

    }

    /**
     * Method return bunch of informations from data base
     * @return mixed - our data
     */
    public function data(){
        return $this->_data;
    }
}