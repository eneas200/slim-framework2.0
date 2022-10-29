<?php

require __DIR__.'/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();
$app->get('/', function (Request $request, Response $response) {
    $message = "App SlimFramework 4.0";
    
    $response->getBody()->write($message);
    
    return $response;
});

$app->run();

