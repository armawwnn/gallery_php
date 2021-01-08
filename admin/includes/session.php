<?php

class Session{
    private $signed_in = false;
    public $user_id;

    public function __construct()
    {
        session_start();
        $this->$this->chek_the_login();
    }

    public function is_signed_in(){
        return $this->signed_in;
    }
    public function login($user){

        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }


    private function chek_the_login (){
        if (isset($_SESSION['user_id'])) {
            $this->user_id =  $_SESSION['user_id'];
            $this->signed_in = true;
        }else{
            unset($this->user_id);
            $this->signed_in = false;
        }

}

}
$session = new Session();
?>