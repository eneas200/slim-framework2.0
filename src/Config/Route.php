<?php 

use Slim\Slim;

$app = new Slim();


$app->get('/:name', function($name) {
    $data = [
        "name" => "Marina",
        "email" => "marina@gmail.com",
        "telefone" => "12222-5555"
    ];

    if($data['name'] == $name) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    } else {
        Echo "
            <script>
                alert('Registro nao encontrado');
            </script>
            ";
    }
});


$app->get('/', function() {
    echo "<p>page inicial</p>";
});

$app->run();