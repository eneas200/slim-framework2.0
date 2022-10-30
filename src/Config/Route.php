<?php 


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addRoutingMiddleware();

session_start();


// atribui um atributo de session
$app->add(function(Request $request, RequestHandler $handler){
    
    // $_SESSION["message"] = "Seja Bem Vindo!";
    $request = $request->withAttribute("session", new stdClass);
    
    return $handler->handle($request);
});


// Retornando json
$app->get('/pong', function (Request $request, Response $response) {
    $payload = array("age" => 15, "name"=> "Maria");
    $body = json_encode($payload);
     
    $response->getBody()->write($body);
    return $response
        ->withHeader("Content-Type", "application/json");
}); 

$app->post('/users', function (Request $request, Response $response) {
    
    $bodyData = $request->getParsedBody();
    var_dump($bodyData);
    $response->getBody()->write("route post");
    
    return $response;
});


$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->run();