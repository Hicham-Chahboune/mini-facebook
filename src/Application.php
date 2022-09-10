<?php

require_once __DIR__.'/Http/Route.php';
require_once __DIR__.'/Http/Request.php';
require_once __DIR__.'./Http/Response.php';
require_once __DIR__.'./Database/Database.php';
require_once __DIR__.'./Session.php';
require_once __DIR__.'./Mail.php';


class Application
{
    protected $route;
    protected $request;
    protected $response;
    protected $db;
    protected $session;
    protected $mail;

    public function __construct(){
        $this->request =new Request();
        $this->response=new Response();
        $this->route = new Route($this->request,$this->response);
        $this->db=new Database;
        $this->session = new Session();
        $this->mail = new Mail();
    }
    public function run(){
        $this->route->resolve();
    }
    public function __get($name)
    {
        if(property_exists($this, $name)) {
            return $this->$name;
        }
    }
}