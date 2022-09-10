<?php
require_once __DIR__.'/..//Application.php';

if(!function_exists('app')){
    function app(){
        static $instance = null;
        if(!$instance){
            $instance=new Application();
        }
        return $instance;
    }
}