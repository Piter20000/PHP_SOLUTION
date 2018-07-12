<?php

class Graph
{
    private $_products;
    private $_db;
    public $_total_products;

    private $Graph1 = array();
    private $Graph2 = array();

    /**
     * Class constructor
     */
    public function __construct(){
        $this->_db = DB::get_Instance();
    }

    /**
     * Method get basic product informations (like name & price) from server
     */
    private function Load_Products_List(){

        $this->_db = new DB();

        // Prepare query
        $query = "SELECT name, price FROM products";

        // Send query into server
        $this->_db->Get_Rows_As_Objects($query);

        // Copy results into local data
        $this->_products = $this->_db->results();
    }

    /**
     * Analize products list
     */
    private function Analyze_Sales(){

        foreach ($this->_products as $product)
        {
        	$this->_db = new DB();

            // Prepare query
            $query = "SELECT SUM(quantity) FROM warehouse WHERE product_name = '{$product->name}'";

            // Send query into server
            $this->_db->get_Row($query);

            // copy result
            $result = $this->_db->results();

            // Check result
            if($result['SUM(quantity)'] == '')
                $quantity = 0;
            else
                $quantity = $result['SUM(quantity)'];

            // Add to total quantity
            $this->_total_products += $quantity;

            // Add into array
            array_push($this->Graph1, ["name"=>$product->name ,"quantity"=>$quantity, "price" => $product->price]);
        }
    }

    /**
     * Method generate Graph1 list
     * @return array
     */
    public function Generate_Graph1_List(){

        self::Load_Products_List();

        self::Analyze_Sales();

        $results = array();

        foreach ($this->Graph1 as $product)
        {
            if($product['quantity'] != 0)
            {
            $procent = (100*$product['quantity'])/$this->_total_products;

        	array_push($results, ["label"=>$product['name'], "y"=>$procent]);
            }
        }

        return $results;
    }

    #region Last 7 days shoppings statystics

    /**
     * Method generate date string
     * @param mixed $day_ago - how many days ago
     * @return string
     */
    private function Get_From_Day($day_ago = null){

        if ($day_ago == null)
            $date = date('Y-m-d');
        else
            $date = date('Y-m-d', strtotime('-'.$day_ago.' days'));

        return $date." 00:00:00";
    }

    public function Get_Stats_From_7_Days(){

        $this->_db = new DB();

        for ($i = 0; $i < 7; $i++)
        {
            // Prepare query
        	$query = "SELECT SUM(quantity) FROM warehouse WHERE (ordered >= '".self::Get_From_Day($i)."') AND (ordered < '".self::Get_From_Day($i-1)."')";

            //echo $query.'<br/>';


            // Send query into server
            $this->_db->get_Row($query);

            $results = $this->_db->results();

            if ($results['SUM(quantity)'] == '')
                $sum = 0;
            else
                $sum = $results['SUM(quantity)'];

            // Copy checked data
            $date = date('Y-m-d', strtotime('-'.$i.' days'));

            array_push($this->Graph2, ["label"=>$date, "y"=>$sum]);

        }
        return $this->Graph2;
    }

    #endregion
}