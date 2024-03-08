<?php

if(isset($_SESSION['admin_name'])){
    unset($_SESSION['admin_name']);
    // unset($_SESSION['admin_role']);

    // sweetAlert("Logout success!","","success");
}



header("Location: ".BASE_URL."/admin-login");