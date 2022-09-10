<?php

require_once __DIR__.'/../../src/View/View.php';
require_once __DIR__.'/../Models/User.php';
require_once __DIR__.'/../Models/Photo.php';
require_once __DIR__.'/../Models/Commentaire.php';
require_once __DIR__.'/../../src/util/utilities.php';
require_once __DIR__.'/../../src/util/utilities.php';


class RegisterLogin{
 
    function displayMessage($class,$message){
      return " <div class='alert alert-".$class." container' role='alert'>"
            .$message.
        "</div>'";
    }
    function doGet(){

       return View::makeOnly('login_singup',[]);
    }

    function doPostLogin(){
        $userModel =new User;
        $login = htmlspecialchars($_POST["login"]);
        $password = htmlspecialchars($_POST["password"]);
        $user =$userModel->getUserByCredentials($login,$password);

        if($user){
            if($user->active){
                app()->session->set("user",$user);
                header("Location: /");    
            }else{
                app()->mail->send_mail($user->email,"Activate your email",$_SERVER["HTTP_HOST"].'/activation?token='.$user->token);
                return View::makeOnly('login_singup',["message"=>$this->displayMessage("danger","Activer votre compte")]);
            }
        } 
        else{
            return View::makeOnly('login_singup',["message"=>$this->displayMessage("danger","Login or password invalid")]);
        }
    }

    function doPostRegister(){
        $userModel =new User;
        $photo =new Photo;
        $email = htmlspecialchars($_POST["email"]);
        $login = htmlspecialchars($_POST["login"]);
        $genre = htmlspecialchars($_POST["genre"][0]);
        $password = htmlspecialchars($_POST["password"]);
        $password1 = htmlspecialchars($_POST["password1"]);
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        if($userModel->getUserByCredentials($login,$password)){
             return View::makeOnly('login_singup',["message"=>$this->displayMessage("danger","Login already exist")]);
        }else if($userModel->checkExistEmail($email)){
            return View::makeOnly('login_singup',["message"=>$this->displayMessage("danger","Email already exist")]);
        }
        else if($password != $password1){
            return View::makeOnly('login_singup',["message"=>$this->displayMessage("danger","password are not the same")]);
        }else{
                $data = array();
                $data["login"]=$login;
                $data["email"]=$email;
                $data["password"]=$password;
                $data["genre"]=$genre;
                $data["token"]=$token;
                $data["idPhoto"]=$id;
                $data["metier"]="undefined";
             if($userModel->insertUser($data)){
                $data = array();
                $data["description"]="Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic eos ullam aperiam quis laudantium vero ea ducimus iure animi. Odio exercitationem amet ex odit ut tempore saepe incidunt soluta nesciunt!";
                $data["proprietaire"]=$login;
                $data["date_photo"]="2022-02-14";
                $data["fichier"]=$genre=="homme"?"photos/man.png":"photos/woman.png";
                $photo->create($data,true);

                $id = $photo->getProfile($login)->id;
                $userModel->setProfile($login,$id);

                app()->mail->send_mail($email,"Activate your email",$_SERVER["HTTP_HOST"].'/activation?token='.$token);
                header("Location: /login");
            }
        }
    }
    function activationEmail(){
        $userModel =new User;
        $token = $_GET["token"];
        $user = $userModel->getUserByToken($token);
        $userModel->update($user->login);
        header("Location: /login");
    }

    function doPostRecover(){
        $userModel =new User;
        $email = htmlspecialchars($_POST["email"]);
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        if($userModel->checkExistEmail($email)){
            $userModel->passwordRecovery($email,$token);
            app()->mail->send_mail($email,"Reset your password",$_SERVER["HTTP_HOST"].'/passwordRecovery?token='.$token);
            header("Location: /login");
        }else{
            echo "not exist";
        }
    }
    function doGetRecover(){
        $userModel =new User;
        $token = htmlspecialchars($_GET["token"]);
        $user = $userModel->getUserByToken($token);
        if($user){
            return View::makeOnly('recovery',["user"=>$user,"token"=>$token]);
        }
        //header("Location: /login");
    }

    function changepassword(){
        $userModel =new User;
        $pass1 = $_POST["pass1"];
        $pass2 = $_POST["pass2"];
        $token = $_POST["token"];
        $login = $_POST["login"];
        if($pass1 != $pass2) return;
        else {
            $user = $userModel->getUserByToken($token);
            if($user->login!=$login)return;
            else{
                if($userModel->updatePassword($login,$pass1)){
                    return View::makeOnly('login_singup');
                }else{
                    return;
                }
            }
        }



    }

    function doLogOut(){
        app()->session->remove("user");
        header("Location: /login");
    }
}