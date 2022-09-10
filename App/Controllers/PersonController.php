<?php

require_once __DIR__.'/../../src/View/View.php';
require_once __DIR__.'/../Models/User.php';
require_once __DIR__.'/../Models/Photo.php';
require_once __DIR__.'/../../src/util/utilities.php';


class PersonController{

    function doGet(){
        $photo=new Photo;
        $personne = $_GET['personne'];
        $photos=$photo->getPhotos($personne);
        $profile=$photo->getProfile($personne);

        return View::make('photos_personne',["photos"=>$photos,"profile"=>$profile,"personne"=>$personne]);
    }
    function getPhotosAjax(){
        $db = new Photo;
        $kw = $_GET["kw"];
        $login = $_GET["login"];

        if(isset($_GET["date1"])){
            $date1=$_GET["date1"];
            $date2=$_GET["date2"];
            $photos = $db->getPhotosBetween($login,$kw,$date1,$date2);
            echo View::makeOnly('photosajax',["photos"=>$photos,"personne"=>$login]);
        }else{
            $photos = $db->getPhotosContains($login,$kw);
            echo View::makeOnly('photosajax',["photos"=>$photos,"personne"=>$login]);
            
        }
        
    }

}