<?php


class Request
{
    public function path()
    {
        $lastIndex = strripos( $_SERVER['REQUEST_URI'],"/");
        $sub = substr($_SERVER['REQUEST_URI'],$lastIndex);
        $path= $sub;
       // $path = $_SERVER['REQUEST_URI'] ?? '/';
        return strpos($path, '?') ? explode('?', $path)[0] : $path;
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']); //get or post
    }

    public function all()
    {
        return $_REQUEST;
    }

    
}
