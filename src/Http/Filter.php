<?php
require_once __DIR__.'/../util/utilities.php';

class Filter
{
    protected $arr;

   
    public static function doFilter(){
        $arr = array("/home","/","/photos_personne","/photo");


        if(in_array($_SERVER['REQUEST_URI'],$arr) & !app()->session->exists("user") )
             header("Location: /login");
    }
   

   
}
