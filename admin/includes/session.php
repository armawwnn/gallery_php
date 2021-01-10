<?php

class Session{
    private $signed_in = false;
    public $user_id;
    public $message;

    public function __construct()
    {
        session_start();
        $this->chek_the_login();
    }

    public function message($msg="") {

        if(!empty($msq)){
            $_SESSION['message']  = $msq;

        }else {
            return $this->message;
        }

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

    public function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
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