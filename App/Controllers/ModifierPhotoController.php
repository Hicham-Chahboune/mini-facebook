<?php

require_once __DIR__.'/../../src/View/View.php';
require_once __DIR__.'/../Models/User.php';
require_once __DIR__.'/../Models/Photo.php';
require_once __DIR__.'/../../src/util/utilities.php';


class ModifierPhotoController{

    function doGet(){
        $id = $_GET['id'];
        $personne = $_GET['personne'];

        $p=new Photo;
        $photo=$p->getPhoto($id);
        return View::make('modifie_photo', ["photo"=>$photo,"personne"=>$personne]);
    }
    function doPost(){
        var_dump($_POST);
    }

}