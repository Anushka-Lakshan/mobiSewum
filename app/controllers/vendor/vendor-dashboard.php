<?php

if(!isset($_SESSION['Vendor_id'])) {
    header("Location: ".BASE_URL."/List_prices");
    die();
}

if($_SESSION['have_shop'] == false) {
    header("Location: ".BASE_URL."/create_shop");
    die();
}

$subpage = 'main';

if(isset($_GET['page'])) {

    if(file_exists("app/views/vendor/subpages/".$_GET['page'].".view.php")) {
        $subpage = $_GET['page'];
    }
    
}

include 'app/views/vendor/dashboard.view.php';