<?php

if(!isset($_SESSION['Vendor_id'])) {
    header("Location: ".BASE_URL."/List_prices");
    die();
}

if($_SESSION['have_shop'] == false) {
    header("Location: ".BASE_URL."/create_shop");
    die();
}

include_once "app/models/Shop.model.php";

$shop = Shop::get_shop_by_id($_SESSION['Vendor_id']);

$approved = $shop[0]['approved'];
$suspended = $shop[0]['suspended'];

if($approved == 0){

    include 'app/views/vendor/unapproved.view.php';
    die();
}

if($suspended == 1){

    include 'app/views/vendor/suspended.view.php';
    die();
}

$subpage = 'main';

if(isset($_GET['page'])) {

    if(file_exists("app/views/vendor/subpages/".$_GET['page'].".view.php")) {
        $subpage = $_GET['page'];
    }
    
}

include 'app/views/vendor/dashboard.view.php';