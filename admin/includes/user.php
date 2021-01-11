<?php
include_once ('init.php');

class User{


    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    public static function find_all_users(){


        return self::find_this_query("SELECT * FROM users");

    }

    public static function find_user_by_id ($user_id) {
        $the_resault_array = self::find_this_query("SELECT * FROM users WHERE id=$user_id LIMIT 1");
        //condition for check
        return !empty($the_resault_array) ? array_shift($the_resault_array) : false;

    }
    // for make easy query
    public static function find_this_query($sql) {
         global $databse;
        $result_set = $databse->query($sql);
        $the_object_array = array();
        while($row = mysqli_fetch_array($result_set)){
            $the_object_array[] = self::instantiation($row);
        }
        return $the_object_array;
    }

    public static function verify_user ($username,$password){
        global $databse;
        $username = $databse->escape_string($username);
        $password = $databse->escape_string($password);

        $sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

        $the_resault_array = self::find_this_query($sql);
        return !empty($the_resault_array) ? array_shift($the_resault_array) : false;
    }

    public static function instantiation($the_record){
        $the_object = new self;

        foreach ( $the_record as $the_attribute => $value ){
            if($the_object->has_the_attribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }
    private function has_the_attribute ($the_attribute){
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute , $object_properties );
    }


    public function create() {
        global $databse;
//        $sql = "INSERT INTO users (username, password, first_name, last_name) VALUES ("$databse->escape_string($this->username)", "$databse->escape_string($this->password)", "$databse->escape_string($this->first_name)", "$databse->escape_string($this->last_name)")";


        $sql  = "INSERT INTO users (username, password, first_name, last_name)";
        $sql .="VALUES('";
        $sql .= $databse->escape_string($this->username) . "', '";
        $sql .= $databse->escape_string($this->password) . "', '";
        $sql .= $databse->escape_string($this->first_name) . "', '";
        $sql .= $databse->escape_string($this->last_name) . "')";


if ($databse->query($sql)) {
    $this->id = $databse->the_insert_id();
    return true;
}else{
    return false;
}

    }

}


?>
