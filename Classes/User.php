<?php

/**
 * Class supporting User
 */
class User {

    private $_db; // Data base connection
    private $_data; // Data from data base
    private $_session_Name; // Session name
    private $_cookie_Name; // Cookie name
    private $_is_Logged_In = false; // If sb is already logged in

    /**
     * Class constructor
     * @param mixed $user
     */
    public function __construct($user = null){

        // Create connection with data base
        $this->_db = DB::get_Instance();

        // Session name
        $this->_session_Name = Config::get('sessions/session_name');

        // Cookie name
        $this->_cookie_Name = Config::get('remember/cookie_name');

        // Check if we are loged in, if not:
        if(!$user){

            // Check if session exists
            if(Session::exists($this->_session_Name)){

                // Copy user UID
                $user = Session::get($this->_session_Name);

                // Find user by UID
                if($this->find($user)){

                // Set flag as true
                $this->_is_Logged_In = true;
                }
            }
                else{
                    // logout
                }
            }
        else
            {
            $this->find($user);
        }
    }

    /**
     * Method check if sb is already logged in
     * @return boolean - result
     */
    public function is_Logged_In(){
        return $this->_is_Logged_In;
    }

    /**
     * Method check if data from data base exists
     * @return boolean - result
     */
    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }

    /**
     * Method return bunch of informations from data base
     * @return mixed - our data
     */
    public function data(){
        return $this->_data;
    }

    /**
     * Summary of log_In
     * @param mixed $username
     * @param mixed $password
     * @param mixed $remember
     */
    public function log_In($username = null, $password = null, $remember = false){
        // If $username != null && $password != null && $_data exists
        if(!$username && !$password && $this->exists())

            // Set new session
            Session::put($this->_session_Name, $this->data()->UID);

        else {
            // Find user in database
            $user = $this->find($username);

            // If user exists
            if($user){
                // Verifie user password
                if(Hash::Verify_Password($password,$this->data()->password)){

                    // Create new session
                    Session::put($this->_session_Name, $this->data()->UID);

                    // If checkbock "remember me" check == true, if is:
                    if($remember){

                        // Send query about session into server
                        $hashCheck = self::get_User_Session();

                        // Check if session exists, if not:
                        // Count(0) == false
                        if(!(count($hashCheck)>0)){

                            // Create hash
                            $hash = Hash::unique();

                            //Prepare query
                            $query = "INSERT INTO users_session(user_id, hash) VALUE({$this->data()->UID},{$hash})";

                            // Send new hash into server
                            $this->_db->insert_Row($query);
                        }
                        // If session
                        else
                            $hash = $hashCheck->hash;

                        Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }
                  return true;
                }
            }
        }
      return false;
    }

    /**
     * Method send query about session hash
     * @return array
     */
    private function get_User_Session(){

        // Prepare query
        $query = "SELECT * FROM users_session WHERE UID = {$this->data()->UID}";

        // Send query into server
        $this->_db->get_Row($query);

        // Return results
        return $this->_db->results();
    }

    /**
     * Method remove row from users_session in data base & local Session & Cookie
     */
    public function log_Out(){

        // Create connection with data base
        $this->_db = DB::get_Instance();

        $query = "DELETE FROM users_session WHERE UID = ?";
        $this->_db->delete_Row($query, array($this->data()->id));

        Session::delete($this->_session_Name);
        Cookie::delete($this->_cookie_Name);
    }

    /**
     * Method create new user basic on data from register form send by $_POST
     * @param mixed $sorce
     */
    public function create_New_User($sorce){

        // Create connection with data base
        $this->_db = DB::get_Instance();

        $nick = $sorce['nick'];
        $fname = escape($sorce['first_Name']); // Sanitize data
        $lname = escape($sorce['last_Name']); // Sanitize data
        $fullname = "{$fname} {$lname}";
        $password = Hash::make_Hash_Password($sorce['password1']);
        $email = $sorce['e-mail'];

        // Prepare query
        $query = "INSERT INTO users (fname, lname, email, fullname, registrationtime, password, nick, lastlogin) VALUE('{$fname}', '{$lname}', '{$email}', '{$fullname}', NOW(), '{$password}', '{$nick}', NOW())";

        // Create new account
        if(!$this->_db->insert_Row($query))
             new Exception('Sorry, there was a problem creating your account!');
    }

    /**
     * Method update e-mail
     * @param mixed $email
     * @param mixed $UID
     * @throws Exception
     */
    public function update($query){

        // Create connection with data base
        $this->_db = DB::get_Instance();

        // Send query into server
        $this->_db->update_Row($query);
    }

    /**
     * Method check if user witch id or e-mail exists in data base
     * @param mixed $user - our id/e-mail
     * @return boolean - result
     */
    public function find($user = null){
        // If $user != null
        if($user){

            // Create connection with data base
            $this->_db = DB::get_Instance();

            // Check incoming type
            $field = (is_numeric($user)) ? 'UID' : 'email';

            // Prepare query
            $query = "SELECT * FROM users WHERE {$field} = '{$user}' LIMIT 1";

            // Send query into server
            $this->_db->Get_Rows_As_Objects($query, array($user));

            // Count results
            if($this->_db->count() > 0){

                // Create instance data from server
                $this->_data = $this->_db->first();

                return true;
            }
        }
        return false;
    }

    /**
     * Method check if in database exists passed Fuid
     * @param mixed $Facebook_UID - our ID
     * @return boolean - return:
     * true - if exists
     * false - if don't
     */
    public function find_FB_ID($Facebook_UID){

        // Create connection with data base
        $this->_db = DB::get_Instance();

        // Prepare query
        $query = "SELECT * FROM users WHERE Fuid = '{$Facebook_UID}' LIMIT 1";

        // Send query into server
        $this->_db->Get_Rows_As_Objects($query);

        // Count results
        if($this->_db->count() > 0){

            // Create instance data from server
            $this->_data = $this->_db->first();

            // Create new session
            Session::put($this->_session_Name, $this->data()->UID);

            return true;
        }
        else
            return false;
    }

    /**
     * Method check if in database exists passed Fuid
     * @param mixed $Gmail_UID - our ID
     * @return boolean - return:
     * true - if exists
     * false - if don't
     */
    public function find_Google_ID($Gmail_UID){

        // Create connection with data base
        $this->_db = DB::get_Instance();

        // Prepare query
        $query = "SELECT * FROM users WHERE Guid = '{$Gmail_UID}' LIMIT 1";

        // Send query into server
        $this->_db->Get_Rows_As_Objects($query);

        // Count results
        if($this->_db->count() > 0){

            // Create instance data from server
            $this->_data = $this->_db->first();

            // Create new session
            Session::put($this->_session_Name, $this->data()->UID);

            return true;
        }
        else
            return false;
    }

    /**
     * Method add new account from Facebook
     */
    public function add_FB_User(){

        // Prepare query
        $query = "INSERT INTO users (Fuid, fname, lname, email, fullname, registrationtime, img, lastlogin) VALUES ('{$_SESSION['Fuid']}','{$_SESSION['fname']}','{$_SESSION['lname']}','{$_SESSION['email']}','{$_SESSION['fullname']}', NOW(),'{$_SESSION['img']}', NOW())";

        // Send query into server
        $this->_db->insert_Row($query);

        // Load data from server ( $this->_data = $this->_db->first() )
        self::find_FB_ID($_SESSION['Fuid']);

        // Set flag as true
        $this->_is_Logged_In = true;
    }

    /**
     * Method add new account from Gmail Account
     */
    public function add_Google_User(){

        // Prepare query
        $query = "INSERT INTO users (Guid, fname, lname, email, fullname, registrationtime, img, lastlogin) VALUES ('{$_SESSION['Guid']}','{$_SESSION['fname']}','{$_SESSION['lname']}','{$_SESSION['email']}','{$_SESSION['fullname']}', NOW(),'{$_SESSION['picture']}', NOW())";

        // Send query into server
        $this->_db->insert_Row($query);

        // Load data from server ( $this->_data = $this->_db->first() )
        self::find_Google_ID($_SESSION['Guid']);

        // Set flag as true
        $this->_is_Logged_In = true;
    }

    public function has_Permission($key){


    }

    /**
     * Method update lastlogin data
     */
    public function Last_Loged_Update(){

        $UID = self::data()->UID;

        // Update query
        $query = "UPDATE users SET lastlogin = NOW() WHERE UID = '{$UID}'";

        // Send query into server
        $this->_db->update_Row($query);
    }

    /**
     * Method send informations about IP into server
     */
    public function Send_IP_Raport(){

        // Get IP data from web
        $data = IP_Data::Get_IP_Data();

        // Copy UID
        $UID = self::data()->UID;

        // Set in_eu as string form
        $in_eu = ($data->in_eu == 1)?"True":"False";

        // Prepare query
        $query = "INSERT INTO ip_data(
                admin_id,
                ip,
                UID,
                visited,
                city,
                region,
                region_code,
                country,
                country_name,
                continent_code,
                in_eu,
                postal,
                latitude,
                longitude,
                timezone,
                utc_offset,
                country_calling_code,
                currency,
                asn,
                org,
                languages)
                VALUES (
                '',
                '{$data->ip}',
                '{$UID}',
                NOW(),
                '{$data->city}',
                '{$data->region}',
                '{$data->region_code}',
                '{$data->country}',
                '{$data->country_name}',
                '{$data->continent_code}',
                '{$in_eu}',
                '{$data->postal}',
                '{$data->latitude}',
                '{$data->longitude}',
                '{$data->timezone}',
                '{$data->utc_offset}',
                '{$data->country_calling_code}',
                '{$data->currency}',
                '{$data->languages}',
                '{$data->asn}',
                '{$data->org}')";

        // Send query into server
        $this->_db->insert_Row($query);
    }

    /**
     * Method send informations about PC into server
     * @return string
     */
    public function Send_PC_Raport(){

        // Get IP adres
        $IP = IP_Data::Get_IP_Data()->ip;

        // Copy UID
        $UID = self::data()->UID;

        // Copy data
        $data = PC_Data::Get_PC_Data();

        // Prepare query
        $query = "INSERT INTO pc_data(
                ip,
                MAC,
                UID,
                windows_version,
                64BitOS,
                pc_name,
                host_name,
                domain_name,
                browser,
                device)
                VALUES (
                '{$IP}',
                '{$data['MAC']}',
                '{$UID}',
                '{$data['windows_version']}',
                '{$data['OS64Bit']}',
                '{$data['pc_name']}',
                '{$data['host_name']}',
                '{$data['domain_name']}',
                '{$data['browser']}',
                '{$data['device']}')";

        // Send query into server
        $this->_db->insert_Row($query);
    }
}