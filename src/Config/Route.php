<?php 
// chamada das classes;
use Slim\Slim;
use Main\Controller\Homepage;
use Main\Controller\ContactPage;


// instance do objeto Slim;
$app = new Slim();


// Rota da Page Contact;
$app->get('/contact', function() {

    $contact = new ContactPage;

    $contact-> index();
    
});

// Rota que carrega a page Index;
$app->get('/', function() {
    
    $page = new HomePage;

    $page->index();

});

// executa as rotas;
$app->run();
