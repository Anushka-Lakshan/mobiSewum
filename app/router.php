<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$uri = str_replace(BASE_URL, '', $uri);


$routes = [
    '/' => 'controllers/index.php',
    '/mobiles' => 'controllers/results.php',
    '/List_prices' => 'controllers/vendor_sign_up.php',
    '/create_shop' => 'controllers/vendor/create_shop.php',
    '/vendor-logout' => 'controllers/vendor/vendor-logout.php',
    '/vendor-dashboard' => 'controllers/vendor/vendor-dashboard.php',
    '/browseByBrand' => 'controllers/browseByBrand.php',
    '/contact-us' => 'controllers/contactUs.php',

    '/run-scrap' => 'web_scrap/run.php',
    '/add_to_database' => 'web_scrap/add_to_database.php',

    '/vendor/AJAX/delete_mobile' => 'controllers/vendor/delete_mobile.php',
    

    // admin routes
    '/admin-login' => 'controllers/admin/login.php',
    '/admin-dashboard' => 'controllers/admin/dashboard.php',
    '/admin-logout' => 'controllers/admin/admin-logout.php',
    '/admin/AJAX/add_brand' => 'controllers/admin/AJAX/add_brand.php',
    '/admin/AJAX/edit_brand' => 'controllers/admin/AJAX/edit_brand.php',
    '/admin/AJAX/delete_brand' => 'controllers/admin/AJAX/delete_brand.php',
    '/admin/AJAX/getScrapedProducts' => 'controllers/admin/AJAX/getScrapedProducts.php',
    '/admin/AJAX/getScrapedRecords' => 'controllers/admin/AJAX/getScrapedRecords.php',
    '/admin/AJAX/add_admin' => 'controllers/admin/AJAX/add_admin.php',
    '/admin/AJAX/edit_admin' => 'controllers/admin/AJAX/edit_admin.php',
    '/admin/AJAX/delete_admin' => 'controllers/admin/AJAX/delete_admin.php',
    '/admin/AJAX/add_online_vendor' => 'controllers/admin/AJAX/add_online_vendor.php',
    '/admin/AJAX/edit_online_vendor' => 'controllers/admin/AJAX/edit_online_vendor.php',
    
];

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        require 'controllers/404.php';
    }
}



routeToController($uri, $routes);