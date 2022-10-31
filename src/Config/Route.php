<?php 


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Main\Config\Middleware\JsonBodyRequest;
use CoffeeCode\DataLayer\Connect;
use Main\Data\Model\Usuario;

$app = AppFactory::create();

$app->addRoutingMiddleware();

 
$app->add(new JsonBodyRequest); 


// listando usuarios da tabela users
$app->get('/users', function(Request $request, Response $response){
    $connect = Connect::getInstance();
    $error = Connect::getError();

    // /*
    // * CHECK connection/errors
    // */
    if ($error) {
        echo $error->getMessage();
        exit;
    }

    $query = "SELECT * FROM users;"; 
    $users = $connect->query($query);
    $users = $users->fetchAll(); 

    $body = json_encode([ 'data' => $users ]);

    $response->getBody()->write($body);
    return $response;
}); 
 

$app->get('/users/{id}', function(Request $request, Response $response, array $args){
    
    $connect = Connect::getInstance();
    $error = Connect::getError();

    // /*
    // * CHECK connection/errors
    // */
    if ($error) {
        echo $error->getMessage();
        exit;
    }

    $userID = (int)$args['id'];
    $query = "SELECT * FROM users where id={$userID};"; 
    $users = $connect->query($query);
    $users = $users->fetch(); 
    if(!$users) {
        $users= ['message' => 'not found'];
    }

    $body = json_encode([ 'data' => $users ]);

    $response->getBody()->write($body);
    return $response;
}); 

$app->post('/users', function (Request $request, Response $response) {
    
    $connect = Connect::getInstance();
    $error = Connect::getError();

    // /*
    // * CHECK connection/errors
    // */
    if ($error) {
        echo $error->getMessage();
        exit;
    }
    $bodyData = $request->getParsedBody();

    $firstname= $bodyData['firstname'];
    $lastname= $bodyData['lastname'];
    if($firstname && $lastname) {
        $query = "INSERT INTO users (firstname,lastname) VALUES ('{$firstname}','{$lastname}')"; 
        $connect->query($query);
    
        $users = $connect->query("SELECT * FROM users where id=LAST_INSERT_ID()");
        $users = $users->fetch();
        $body = json_encode([ 'data' => $users ]);
    } else {
        $body = json_encode([ 'data' => $bodyData, 'error'=>['preencha os campos obrigatórios'] ]);
    }
     
    $response->getBody()->write($body);
    
    return $response
        ->withHeader("Content-Type", "application/json");
});

$app->put('/users/{userID}', function (Request $request, Response $response, array $args) {
    
    $connect = Connect::getInstance();
    $error = Connect::getError();

    // /*
    // * CHECK connection/errors
    // */
    if ($error) {
        echo $error->getMessage();
        exit;
    }

    if(!empty($args['userID'])){
        $bodyData = $request->getParsedBody();
        
        $userID = (int)$args['userID'];
        $firstname= $bodyData['firstname'];
        $lastname= $bodyData['lastname'];
        if($firstname && $lastname) {
            $query = "UPDATE users SET firstname='{$firstname}',lastname='{$lastname}' WHERE id={$userID}"; 
            $connect->query($query);
        
            $users = $connect->query("SELECT * FROM users where id={$userID}");
            $users = $users->fetch();
            $body = json_encode([ 'data' => $users ]);
        } else {
            $body = json_encode([ 'data' => $bodyData, 'error'=>['preencha os campos obrigatórios'] ]);
        }
    } else {
        $body = json_encode([ 'error'=>['preencha os campos obrigatórios'] ]);
    }

    $response->getBody()->write($body);
    
    return $response
        ->withHeader("Content-Type", "application/json");
});

$app->delete('/users/{userID}', function (Request $request, Response $response, array $args) {
    
    $connect = Connect::getInstance();
    $error = Connect::getError();

    // /*
    // * CHECK connection/errors
    // */
    if ($error) {
        echo $error->getMessage();
        exit;
    }

    if(!empty($args['userID'])){
        
        $userID = (int)$args['userID'];
        
        $query = "SELECT * FROM users WHERE id={$userID}";
        $user = $connect->query($query);
        $user = $user->fetch();
        if(!$user) { // se não encontrado o usuario pelo id entra aqui no if
            $response->getBody()->write(json_encode([
                'message' => [
                    "user id {$userID} not found"
                ]
            ]));
            $code = 404;
        } else { // nesse caso o usuario foi encontrado então vamos remover da tabela
            $query = "DELETE FROM users WHERE id={$userID}"; 
            $connect->query($query);
            $code = 204;
        }
    }
    
    return $response
        ->withHeader("Content-Type", "application/json")
        ->withStatus($code);
});



$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->run();