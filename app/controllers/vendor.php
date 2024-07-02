<?php

if(!isset($_GET['vendor'])) {
    header("Location: " . BASE_URL . "/");
    die();
}

$vendor = $_GET['vendor'];

// get shop details
include_once 'app/models/Shop.model.php';

$shop = Shop::get_shop_by_id($vendor);

if(count($shop) == 0) {
    header("Location: " . BASE_URL . "/");
    die();
}

$shop = $shop[0];



include "app/models/VendorProducts.model.php";

$Products = VendorProducts::get_by_vendor($vendor);

// show($Products);

include_once 'app/views/vendor.view.php';