<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$uri = str_replace(BASE_URL, '', $uri);


$routes = [
    '/' => 'controllers/index.php',
    '/run' => 'web_scrap/run.php',
    '/add_to_database' => 'web_scrap/add_to_database.php',
    
];

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        require 'controllers/404.php';
    }
}



routeToController($uri, $routes);