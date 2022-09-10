<?php 

require_once __DIR__.'/../Routes/web.php';
require_once __DIR__.'/../src/Http/Route.php';
require_once __DIR__.'/../src/Http/Request.php';
require_once __DIR__.'/../src/Http/Response.php';
require_once __DIR__.'/../src/util/utilities.php';


//$route = new Route(new Request,new Response);

//$route->resolve();
header("Access-Control-Allow-Origin: *");

app()->run();


