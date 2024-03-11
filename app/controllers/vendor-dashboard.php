<?php

if(!isset($_SESSION['Vendor_id']) && !isset($_SESSION['username'])) {
    header("Location: ".BASE_URL."/List_prices");
    die();
}

if($_SESSION['have_shop'] == false) {
    header("Location: ".BASE_URL."/create_shop");
    die();
}