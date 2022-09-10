<?php
require_once __DIR__.'/../../src/util/utilities.php';

class Photo{
    private $db;

    public function __construct(){
        $this->db = app()->db;
    }

    public function getPhotos($login){
        $this->db->query("SELECT * 
                        FROM photo 
                        WHERE photo.proprietaire =:login and isProfile=0");

        $this->db->bind(':login',$login);

        // asiign result set
        $result = $this->db->resultSet();
        return $result;                
    }
    public function getPhotosContains($login,$kw){
        $this->db->query("SELECT * 
                        FROM photo 
                        WHERE photo.proprietaire =:login and UPPER(description) like UPPER(:kw) and isProfile=0");

        $this->db->bind(':login',$login);
        $this->db->bind(':kw','%'.$kw.'%');

        // asiign result set
        $result = $this->db->resultSet();
        return $result;                
    }
    public function getPhotosBetween($login,$kw,$date1,$date2){
        $this->db->query("SELECT * 
                        FROM photo 
                        WHERE photo.proprietaire =:login and UPPER(description) like UPPER(:kw) and date_photo between :date1 and :date2 and isProfile=0");

        $this->db->bind(':login',$login);
        $this->db->bind(':date1',$date1);
        $this->db->bind(':date2',$date2);
        $this->db->bind(':kw','%'.$kw.'%');

        // asiign result set
        $result = $this->db->resultSet();
        return $result;                
    }
    public function getIdPhoto($login,$file){
        $this->db->query("SELECT * 
                        FROM photo 
                        WHERE photo.proprietaire =:login and fichier=:file");

        $this->db->bind(':login',$login);
        $this->db->bind(':file',$file);

        // asiign result set
        $result = $this->db->single();
        return $result;                
    }
    public function getPhoto($id){
        $this->db->query("SELECT * 
                        FROM photo 
                        WHERE photo.id =:id");

        $this->db->bind(':id',$id);
        // asiign result set
        $result = $this->db->single();
        return $result;                
    }
    public function create($data,$profile=false){
        $this->db->query("INSERT INTO photo (fichier,date_photo, description, proprietaire,isProfile) 
                                    VALUES (:fichier,:date_photo,:description,:proprietaire,:isp)");
        $this->db->bind(':fichier',$data["fichier"]);
        $this->db->bind(':date_photo',$data["date_photo"]);
        $this->db->bind(':proprietaire',$data["proprietaire"]);
        $this->db->bind(':description',$data["description"]);
        $this->db->bind(':isp',$profile);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function getProfile($login){
        $this->db->query("SELECT * 
                        FROM photo 
                        WHERE proprietaire like :login and isProfile = 1 ");

        $this->db->bind(':login',$login);
        // asiign result set
        $result = $this->db->single();
        return $result; 
    } 
    public function updateProfile($fichier,$login){
        $this->db->query("UPDATE photo set fichier=:fichier WHERE id=:login");
          $this->db->bind(':fichier',$fichier);
          $this->db->bind(':login',$login);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    
   
  
    public function getPhotoProfile($id_photo_profile){
        $this->db->query("SELECT * From phto where proprietaire=:id_photo_profil");
        // asiign result set
        $this->db->bind(':id_photo_profil',$id_photo_profile);
        $result = $this->db->single();
        return $result;
    }

    public function add($data,$login){
        $this->db->query("INSERT INTO photo (fichier, description, proprietaire) 
                                    VALUES (:fichier,:description,:proprietaire)");
        $this->db->bind(':fichier',$data["fichier"]);
        $this->db->bind(':description',$data["description"]);
        $this->db->bind(':proprietaire',$login);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function update($id,$description,$date){
        $this->db->query("UPDATE photo set
         date_photo=:date_photo, description=:description 
         WHERE id=$id");
       $this->db->bind(':date_photo',$date);
       $this->db->bind(':description',$description);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function delete($id){
        $this->db->query("DELETE FROM photo where id=:id");
        $this->db->bind(':id',$id);

       if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
      

}