<?php

require_once __DIR__.'/../../src/View/View.php';
require_once __DIR__.'/../Models/User.php';
require_once __DIR__.'/../../src/util/utilities.php';

 
class HomeController{

    function doGet(){
        $user = new User;
        $login="";
        if(isset($_GET["user"])){
            $login = $_GET["user"];
        }

        $users= $user->getAllUsers("%".$login."%");
        return View::make('home',["users"=>$users,"me"=>app()->session->get("user")]);
    }

    function doAjax(){
        $user = new User;
        $login="";
        if(isset($_GET["user"])){
            $login = $_GET["user"];
        }
        $users= $user->getAllUsers("%".$login."%");
        return View::makeOnly('search',["users"=>$users]);
    }

    function doPost(){

        var_dump($_FILES['photo']);

    }
   

}
