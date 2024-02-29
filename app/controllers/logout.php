<?php

if(isset($_SESSION['Customer_Id'])){
    unset($_SESSION['Customer_Id']);
    unset($_SESSION['Customer_Name']);
}

sweetAlert("Logout success!","We hope to welcome you back soon","success");

header("Location: ".BASE_URL."/");