
<?php
require_once __DIR__.'/../../src/util/utilities.php';

class Commentaire{
    private $db;

    public function __construct(){
        $this->db = app()->db;
    }

    public function getCommentsByPhoto($id_photo){
        $this->db->query("SELECT commentaire.*,photo.fichier as 'profile'
                        FROM commentaire 
                         inner join photo on proprietaire like auteur and isProfile=1 WHERE commentaire.id_photo=:id_photo order by depot desc");

        $this->db->bind(':id_photo',$id_photo );
        // asiign result set
        $result = $this->db->resultSet();
        return $result;                
    }

    public function getSingleComment($id_photo,$auteur,$contenu){
        $this->db->query("SELECT commentaire.*,photo.fichier as 'profile'
                        FROM commentaire 
                         inner join photo on proprietaire like auteur and isProfile=1 WHERE commentaire.id_photo=:id_photo and auteur=:auteur and contenu=:contenu");

        $this->db->bind(':id_photo',$id_photo );
        $this->db->bind(':auteur',$auteur );
        $this->db->bind(':contenu',$contenu );
        // asiign result set
        $result = $this->db->single();
        return $result;                
    }
  
    public function getCommentsByAuthor($auteur_id){
        $this->db->query("SELECT * From photo where auteur =:auteur");
        // asiign result set
        $this->db->bind(':auteur ',$auteur_id);
        $result = $this->db->single();
        return $result;
    }

    public function addComment($data,$id_photo,$auteur_id){
        $this->db->query("INSERT INTO commentaire (contenu ,id_photo , auteur ) 
                                    VALUES (:contenu,:id_photo ,:auteur )");
        $this->db->bind(':contenu',$data);
        $this->db->bind(':id_photo',$id_photo);
        $this->db->bind(':auteur',$auteur_id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    
    public function update($id,$data){
        $this->db->query("UPDATE photo set
         fichier=:fichier,date_photo=:date_photo, description=:description 
         WHERE id=$id");
       $this->db->bind(':fichier',$data["fichier"]);
       $this->db->bind(':date_photo',$data["date_photo"]);
       $this->db->bind(':description',$data["description"]);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    function deleteById($id){
        $this->db->query("DELETE FROM `commentaire` WHERE id=:id");
        $this->db->bind(':id',$id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    function deleteByIdPic($id){
        $this->db->query("DELETE FROM `commentaire` WHERE id_photo=:id");
        $this->db->bind(':id',$id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}















   