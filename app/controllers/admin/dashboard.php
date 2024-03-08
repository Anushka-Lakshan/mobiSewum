<?php

if(!isset($_SESSION['admin_name'])){
    header("Location: ".BASE_URL."/admin-login");
    die;
    
}

$subpage = 'main';

if(isset($_GET['page'])) {

    if(file_exists("app/views/admin/subpages/".$_GET['page'].".view.php")) {
        $subpage = $_GET['page'];
    }
    
}

include("app/views/admin/dashboard.view.php");