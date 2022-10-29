<?php 


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;

$app = AppFactory::create();


$app->add(function(Request $request, RequestHandler $handler){
    $headers = $request->getHeaders();
    foreach($headers as $name => $values) {
        echo "<p>".$name.":".implode(", ", $values)."</p>";
    }

    // obtem um cabeçario
    $accept = $request->getHeader("Accept");
    echo "<p>Header Accept:</p>";
    $accept = explode(",", implode(',', $accept));
    foreach ($accept as $key => $value) {
        print "<p>{$key}:{$value}</p>";
    }


    return $handler->handle($request);
});


$app->get('/', function (Request $request, Response $response) {
    $message = "App SlimFramework 4.0";
    echo "<p>function</p>";
    $response->getBody()->write($message);
    
    return $response;
});


$app->post('/users', function (Request $request, Response $response) {
    
    $bodyData = $request->getParsedBody();
    var_dump($bodyData);
    $response->getBody()->write("route post");
    
    return $response;
});

$app->run();