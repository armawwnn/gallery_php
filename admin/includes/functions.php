<?php

function classAutoloader($class){
    $the_path = "includes/{$class}.php";
    if (file_exists($the_path)) {
        require_once ($the_path);
    }else{
        die("this file {class}.php was not man ... ");
    }

}

function redirect($location){
    header("Location: {$location}");

}

spl_autoload_register('classAutoloader');
?>
