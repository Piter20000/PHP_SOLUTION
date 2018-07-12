<?php

/**
 * Class supporting connection with Data Base
 */
class DB {

    private static $_instance = null; // Data base connection instance
    private $_pdo; // Data base connection
    private	$_query; // Data base query
    private $_error = false; // error Flag


    private $_results; // Connection results
    private $_count = 0; // Rows count

    /**
     * Class constructor
     * @throws Exception
     */
    public function __construct()
	{
        $this->isConn = TRUE;
        try
		{
            // Create connection
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));

            // Set defoult error mode as PDOEXCEPTION
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Set defoult fetch as assoc
            $this->_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
		catch (PDOException $e)
		{
            throw new Exception($e->getMessage());
        }

    }

    #region ### Public methods ###

        /**
         * Method check if DB connection allready exists, else create instance
         * @return DB - DB instance
         */
        public static function get_Instance(){

            // Check if connection exists
            if(!(self::$_instance)){
                self::$_instance = new DB();
            }
            else return self::$_instance;
        }

            #region ### Get row/rows form data base ###

                /**
                 * Method get single row from data base
                 * @param mixed $query - our query
                 * @param mixed $params - our params
                 * @throws Exception - in case, error informations
                 */
                public function get_Row($query, $params = []){

                    try {

                        // Error FLAG
                        $this->_error = false;

                        // Prepare query
                        $this->_query = $this->_pdo->prepare($query);

                        // Execute query using $params
                        $this->_query->execute($params);

                        // Copy results into $_results
                        $this->_results = $this->_query->fetch();

                        // Copy number of results
                        $this->_count = $this->_query->rowCount();
                    }
                    catch (PDOException $e){

                        // Error FLAG
                        $this->_error = true;

                        throw new Exception( $e->getMessage());
                    }
                }

                /**
                 * Method get rows from data base
                 * @param mixed $query - our query
                 * @param mixed $params - our params
                 * @throws Exception - in case, error informations
                 */
                public function get_Rows($query, $params = [] ){

                    try{

                        // Error FLAG
                        $this->_error = false;

                        // Prepare query
                        $this->_query = $this->_pdo->prepare($query);

                        // Execute query using $params
                        $this->_query->execute($params);

                        // Copy results into $_results
                        $this->_results = $this->_query->fetchAll();

                        // Copy number of results
                        $this->_count = $this->_query->rowCount();
                    }
                    catch (PDOException $e){

                        // Error FLAG
                        $this->_error = true;

                        throw new Exception($e->getMessage());
                    }
                }

                /**
                 * Method get single row from data base as object
                 * @param mixed $query - our query
                 * @param mixed $params - our params
                 * @throws Exception - in case, error informations
                 */
                public function Get_Row_As_Object($query, $params = []){

                    try {

                        // Error FLAG
                        $this->_error = false;

                        // Prepare query
                        $this->_query = $this->_pdo->prepare($query);

                        // Execute query using $params
                        $this->_query->execute($params);

                        // Copy results into $_results
                        $this->_results = $this->_query->fetch(PDO::FETCH_OBJ);

                        // Copy number of results
                        $this->_count = $this->_query->rowCount();
                    }
                    catch (PDOException $e){

                        // Error FLAG
                        $this->_error = true;

                        throw new Exception( $e->getMessage());
                    }
                }

                /**
                 * Method get rows from data base as object
                 * @param mixed $query - our query
                 * @param mixed $params - our params
                 * @throws Exception - in case, error informations
                 */
                public function Get_Rows_As_Objects($query, $params = []){

                    try {

                        // Error FLAG
                        $this->_error = false;

                        // Prepare query
                        $this->_query = $this->_pdo->prepare($query);

                        // Execute query using $params
                        $this->_query->execute($params);

                        // Copy results into $_results
                        $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);

                        // Copy number of results
                        $this->_count = $this->_query->rowCount();
                    }
                    catch (PDOException $e){

                        // Error FLAG
                        $this->_error = true;

                        throw new Exception( $e->getMessage());
                    }
                }

            #endregion

            #region ### Insert & Update & Delete Row ###

                /**
                 * Method insert row into data base
                 * @param mixed $query - our query
                 * @param mixed $params - our params
                 * @throws Exception - in case, error informations
                 * @return boolean - if all ok, return true, else false
                 */
                public function insert_Row($query, $params = []){

                    try{
                        // Error FLAG
                        $this->_error = false;

                        // Prepare query
                        $this->_query = $this->_pdo->prepare($query);

                        // Send query into server
                        $this->_query->execute($params);

                        return true;
                    }
                    catch (PDOException $e){

                        // Error FLAG
                        $this->_error = true;

                        throw new Exception($e->getMessage());
                    }
                }

                /**
                 * Method update row in data base
                 * @param mixed $query - our query
                 * @param mixed $params - our params
                 */
                public function update_Row($query, $params = []){
                    $this->insert_Row($query,$params);
                }

                /**
                 * Method delete indicated rows from data base
                 * @param mixed $query - our query
                 * @param mixed $params - our params
                 */
                public function delete_Row($query, $params = []){
                    $this->insert_Row($query,$params);
                }

            #endregion

                /**
                 * Method return from DB $_results
                 * @return array
                 */
                public function results() {
                    return $this->_results;
                }

                /**
                 * Method return first array from DB $_results
                 * @return mixed
                 */
                public function first() {
                    $data = $this->results();
                    return $data[0];
                }

                /**
                 * Method return number of results from DB $_results
                 * @return mixed
                 */
                public function count() {
                    return $this->_count;
                }

                /**
                 * Method return error status
                 * @return boolean
                 */
                public function error() {
                    return $this->_error;
                }

    #endregion
}

?>