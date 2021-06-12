<?php

use Rain\Tpl;
define('baseUrl', 'http://localhost/slimframework2.0');



// configuração do framework Rain/Tpl, que faz o carregamento das paginas e cache de páginas
define('CONFIG', array(
        "tpl_dir" => "view",
        "cache_dir" => "src/cache/"
));
Tpl::configure( CONFIG );