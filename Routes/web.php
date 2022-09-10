<?php


require_once __DIR__.'/../src/Http/Route.php';
require_once __DIR__.'/../src/Http/Filter.php';
require_once __DIR__.'/../App/Controllers/HomeController.php';
require_once __DIR__.'/../App/Controllers/PhotoController.php';
require_once __DIR__.'/../App/Controllers/PersonController.php';
require_once __DIR__.'/../App/Controllers/AjouterPhotoController.php';
require_once __DIR__.'/../App/Controllers/ModifierPhotoController.php';
require_once __DIR__.'/../App/Controllers/RegisterLogin.php';

Filter::doFilter();

Route::get("/",[HomeController::class,"doGet"]);
Route::get("/home",[HomeController::class,"doGet"]);

Route::post("/",[HomeController::class,"doPost"]);
Route::post("/home",[HomeController::class,"doPost"]);

Route::get("/ajax",[HomeController::class,"doAjax"]);

Route::get("/login",[RegisterLogin::class,"doGet"]);
Route::get("/register",[RegisterLogin::class,"doGet"]);
Route::get("/deconnecte",[RegisterLogin::class,"doLogOut"]);
Route::get("/activation",[RegisterLogin::class,"activationEmail"]);
Route::get("/passwordRecovery",[RegisterLogin::class,"doGetRecover"]);

Route::post("/changepassword",[RegisterLogin::class,"changepassword"]);


Route::post("/login",[RegisterLogin::class,"doPostLogin"]);
Route::post("/register",[RegisterLogin::class,"doPostRegister"]);
Route::post("/passwordRecovery",[RegisterLogin::class,"doPostRecover"]);


Route::get("/photo",[PhotoController::class,"doGet"]);
Route::post("/photo",[PhotoController::class,"doPost"]);
Route::post("/deletecomment",[PhotoController::class,"deletecomment"]);
Route::get("/supprimerphoto",[PhotoController::class,"supprimerphoto"]);


Route::get("/photos_personne",[PersonController::class,"doGet"]);
Route::post("/photos_personne",[PersonController::class,"doPost"]);
Route::get("/getPhotosAjax",[PersonController::class,"getPhotosAjax"]);


Route::post("/ajoute_photo",[AjouterPhotoController::class,"doPost"]);
Route::post("/modifier_profile",[AjouterPhotoController::class,"doProfile"]);

Route::get("/modifie_photo",[ModifierPhotoController::class,"doGet"]);
Route::post("/modifie_photo",[ModifierPhotoController::class,"doPost"]);
