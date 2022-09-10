<?php
require_once __DIR__.'/../../src/util/utilities.php';

class User{
    private $db;

    public function __construct(){
        $this->db = app()->db;
    }


    //get All jobs
    public function getAllUsers($login){
        $this->db->query("SELECT utilisateur.*,photo.fichier as 'profile'
                        From utilisateur INNER JOIN photo
                        ON utilisateur.idPhoto = photo.id where UPPER(login) like UPPER(:login)");
        // asiign result set
        $this->db->bind(':login',$login);
        $result = $this->db->resultSet();
        return $result;                
    }

    public function getUserByCredentials($login,$password){
        $this->db->query("SELECT * From utilisateur where login like :login and password like :password");
        // asiign result set
        $this->db->bind(':login',$login);
        $this->db->bind(':password',hash('ripemd160', $password));
        $result = $this->db->single();
        return $result;                
    }

    public function getUserByToken($token){
        $this->db->query("SELECT * From utilisateur where token like :token");
        // asiign result set
        $this->db->bind(':token',$token);
        $result = $this->db->single();
        return $result;                
    }



    public function insertUser($data){
        $this->db->query("INSERT INTO utilisateur (login,email,password,genre,token,active,metier) 
                                    VALUES (:login,:email,:password,:genre,:token,0,:metier)");
        $this->db->bind(':login',$data["login"]);
        $this->db->bind(':email',$data["email"]);
        $this->db->bind(':password',hash('ripemd160', $data["password"]));
        $this->db->bind(':genre',$data["genre"]);
        $this->db->bind(':token',$data["token"]);
        $this->db->bind(':metier',$data["metier"]);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function checkExistEmail($email){
        $this->db->query("SELECT * From utilisateur where email like :email");
        // asiign result set
        $this->db->bind(':email',$email);
        $result = $this->db->single();
        return $result;
    }

    
    public function passwordRecovery($email,$token){
        $this->db->query("UPDATE utilisateur set
          token=:token where email=:email");
        $this->db->bind(':email',$email);
        $this->db->bind(':token',$token);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function update($id){
        $this->db->query("UPDATE utilisateur set
          active=1 where login=:id");
        $this->db->bind(':id',$id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateUser($desc,$metier,$login){
        $this->db->query("UPDATE utilisateur set
          desc_user=:desc,metier=:metier where login=:id");
        $this->db->bind(':desc',$desc);
        $this->db->bind(':metier',$metier);
        $this->db->bind(':id',$login);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function setProfile($login,$idphoto){
        $this->db->query("UPDATE utilisateur set
          idPhoto=:idphoto where login=:id");
        $this->db->bind(':id',$login);
        $this->db->bind(':idphoto',$idphoto);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updatePassword($login,$password){
        $this->db->query("UPDATE utilisateur set
          password=:password where login=:login");
        $this->db->bind(':login',$login);
        $this->db->bind(':password',hash('ripemd160', $password));

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

}