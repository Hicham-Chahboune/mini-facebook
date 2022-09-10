<?php

require_once __DIR__.'/../../src/View/View.php';
require_once __DIR__.'/../Models/User.php';
require_once __DIR__.'/../Models/Photo.php';
require_once __DIR__.'/../Models/Commentaire.php';
require_once __DIR__.'/../../src/util/utilities.php';


class PhotoController{

    function doGet(){
        $id = $_GET['id'];
        $personne = $_GET['personne'];
        $p=new Photo;
        $c=new Commentaire;
        $commentaires=$c->getCommentsByPhoto($id);
        $profile=$p->getProfile($personne);
        $photo=$p->getPhoto($id);
        return View::make('photo',["photo"=>$photo,"commentaires"=>$commentaires,"profile"=>$profile,"user"=>app()->session->get("user")]);
    }
    function deletecomment(){
        $id = $_GET['id'];
        $c=new Commentaire;
        $commentaires=$c->deleteById($id);
        return $commentaires;
    }

    function supprimerphoto(){
        $c=new Commentaire;
        $p=new Photo;
        $id = $_GET["id"];
        $c->deleteByIdPic($id);
        $p->delete($id);
        header("Location: /");
    }
    
    function doPost(){
        if (isset($_POST['modifier_photo'])) {
            $photo = new Photo;
            $description = addslashes($_POST['description']);
            $date = addslashes($_POST['date']);
            $id = addslashes($_POST['id']);
            $personne = $_POST['personne'];
            $photo->update($id,$description,$date);
            header("Location: /photo?id=".$id."&personne=".$personne);
        }   
               
        else {
            $commentaire = new Commentaire;
            $contenu = $_GET['comment'];
            $id_photo = $_GET['id_photo'];
            $auteur = $_GET['auteur'];
            $prop = $_GET['prop'];
            $commentaire->addComment($contenu,$id_photo,$auteur);
            $commentaires=$commentaire->getSingleComment($id_photo,$auteur,$contenu);
            echo View::makeOnly('comments',["commentaire"=>$commentaires,"prop"=>$prop]);
        }
      

       
    }
}


