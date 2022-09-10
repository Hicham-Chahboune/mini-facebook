<?php

require_once __DIR__.'/../../src/View/View.php';
require_once __DIR__.'/../Models/Photo.php';
require_once __DIR__.'/../Models/User.php';
require_once __DIR__.'/../../src/util/utilities.php';

 
class AjouterPhotoController{

    function doPost(){
        $db = new Photo;
        if (isset($_POST['description'])) {
            $description = addslashes($_POST['description']);
        } else {
            $description = "";
        }
        $date_photo = $_POST['date'];
        $login = $_POST['proprietaire'];
        $file = $this->checkSave("photo","photos/".$login);
        if ($file != null) {
            $data = array();
            $data["description"]=$description;
            $data["proprietaire"]=$login;
            $data["date_photo"]=$date_photo;
            $data["fichier"]=$file;

            if($db->create($data)){
                $photo=$db->getIdPhoto($login,$file);
                header("Location: /modifie_photo?id=".$photo->id."&personne=".$login);
            } 
            else "not added";
            
        }
        else {
            print "<p><b>Echec de l'ajout de la photo !!!</b></p>";
        }  
    }

    function doProfile(){
        $db = new Photo;
        $user =new User;
        $desc_user = "";
        if (isset($_POST['description'])) {
            $desc_user = addslashes($_POST['description']);
        }
        $metier = $_POST['metier'];
        $login = $_POST['proprietaire'];
        $idphoto = $_POST['idphoto'];
        $file = $this->checkSave("phphto","photos/".$login);
        if ($file != null) {
            $db->updateProfile($file,$idphoto);
            $user->updateUser($desc_user,$metier,$login);
             header("Location: /");
        }
    }

    function checkSave($param_fichier,$chemin_destination){

        if ($_FILES[$param_fichier]['error']) {
            switch ($_FILES[$param_fichier]['error']){
            case UPLOAD_ERR_INI_SIZE:
                   print "Le fichier depasse la limite autorisee par le serveur (fichier php.ini).";
                   break;
            case UPLOAD_ERR_FORM_SIZE:
                   print "Le fichier depasse la limite autorisee dans le formulaire HTML.";
                   break;
            case UPLOAD_ERR_PARTIAL:
                   print "L'envoi du fichier a ete interrompu pendant le transfert.";
                  break;
            case UPLOAD_ERR_NO_FILE:
                   print "Le fichier que vous avez envoye a une taille nulle.";
                 break;
             case UPLOAD_ERR_NO_TMP_DIR:
                 print "Pas de repertoire temporaire defini.";
                 break;
             case UPLOAD_ERR_CANT_WRITE:
                 print "Ecriture du fichier impossible.";
             default:
                print "Erreur inconnue.";
            }
            return null;
        }else{
            return $this->save_photo($chemin_destination,$param_fichier);
        }
    }

    function save_photo($chemin_destination,$param_fichier){
        if(!file_exists($chemin_destination))
             mkdir($chemin_destination);
        $chemin_destination = $chemin_destination.'/';

        $urlphoto=$chemin_destination.$_FILES[$param_fichier]['name'];

	 	$urlphoto=$this->genere_nom_fichier($urlphoto);
        move_uploaded_file($_FILES[$param_fichier]['tmp_name'],$urlphoto);
        return $urlphoto;
    }

    function genere_nom_fichier($nom_depart) {
        if (file_exists($nom_depart)) {
                $ppos = strrpos($nom_depart,'.');
                $ext = substr($nom_depart,$ppos);
                $prefix = substr($nom_depart,0,$ppos);
                $i=0;
            while(file_exists("$prefix$i$ext")) {
                $i++;
            }
            return $prefix.$i.$ext;
        } else {
            return $nom_depart;
        }
    }

}
