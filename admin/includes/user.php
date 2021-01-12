<?php
include_once ('init.php');

class User{


    protected static $db_table = "users";
    protected static $db_table_fields = array('username','password','first_name',"last_name");
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


    protected function properties(){
        $properties = array();
        foreach(self::$db_table_fields as $db_field){
            if (property_exists($this,$db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }

        return $properties;
    }

    protected function clean_properties (){
        global $databse;

        $clean_properties = array();

        foreach ($this->properties() as $key => $value){

            $clean_properties[$key] = $databse->escape_string($value);

        }

        return $clean_properties;
    }

    public function save(){

        return isset($this->id) ? $this->update() : $this->create();

    }


    public function create() {
        global $databse;


        $properties = $this->clean_properties();

        $sql  = "INSERT INTO " . self::$db_table . "(" . implode("," , array_keys($properties)). ")";
        $sql .="VALUES('". implode("','" , array_values($properties)) ."')";


if ($databse->query($sql)) {
    $this->id = $databse->the_insert_id();
    return true;
}else{
    return false;
}

    }//create Method

    public function update(){
        global $databse;

        $properties = $this->clean_properties();
        $properties_pair = array();
        foreach ($properties as $key => $value){
            $properties_pair[] = "{$key}='{$value}'";
        }

        $sql  = "UPDATE " . self::$db_table . " SET ";
        $sql .=implode(", ",$properties_pair);
        $sql .=" WHERE id= " . $databse->escape_string($this->id);
        $databse->query($sql);

        return (mysqli_affected_rows($databse->connection) == 1) ? true : false;

    } //end of update method


    public function delete(){
        global $databse;
        $sql  = "DELETE FROM " . self::$db_table . " WHERE id= ";
        $sql .=  $databse->escape_string($this->id);
        $sql .=" LIMIT 1";
        $databse->query($sql);
        return (mysqli_affected_rows($databse->connection) == 1) ? true : false;
    }

}


?>
