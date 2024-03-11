<?php

if(isset($_SESSION['Vendor_id'])){
    unset($_SESSION['username']);
    unset($_SESSION['Vendor_id']);
    unset($_SESSION['have_shop']);
}



header("Location: ".BASE_URL."/List_prices");