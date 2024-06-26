<?php

include("app/models/Brands.model.php");

$brands = Brands::get_all();

include("app/models/results.model.php");
include("app/core/Validator.php");

$error = array();
$result = array();

$mobile = "";
$brand = "";
$min = 0;
$max = 100000000;
$sort = "ASC";
$group = true;
$only_inStock = false;

if(isset($_GET['phone']) && !empty($_GET['phone']))
{
    if(Validator::string($_GET['phone'])){
        $mobile = Validator::sanitizeInput($_GET['phone']);
    }
}

if(isset($_GET['brand']) && !empty($_GET['brand'])){
    
    $brand = Validator::sanitizeInput($_GET['brand']);
}


if(isset($_GET['min']) && !empty($_GET['min']) && is_int((int) $_GET['min']) && ((int) $_GET['min']) >= 0){
    $min = (int) Validator::sanitizeInput($_GET['min']);
}
elseif(isset($_GET['min']) && !empty($_GET['min']) && !is_int((int) $_GET['min']) ){
    array_push($error, "Minimum price must be a positive integer");
}

if(isset($_GET['max']) && !empty($_GET['max']) && is_int((int) $_GET['max']) && ((int) $_GET['max']) >= 0){
    $max = (int) Validator::sanitizeInput($_GET['max']);
}
elseif(isset($_GET['max']) && !empty($_GET['max']) && !is_int((int) $_GET['max'])){
    array_push($error, "Maximum price must be a positive integer");
}



if( !($max > $min) ){
    array_push($error, "Maximum price must be greater than minimum price");
}

if(isset($_GET['sort'])){
    $sort = Validator::sanitizeInput($_GET['sort']);

    if($sort != "toHigh" && $sort != "toLow"){
        $sort = "ASC";
    }
    else if($sort == "toHigh"){
        $sort = "ASC";
    }
    else{
        $sort = "DESC";
    }
}

if(isset($_GET['not-group']) && $_GET['not-group'] == "on"){
    $group = false;
}

if(isset($_GET['in-stock']) && $_GET['in-stock'] == "on"){
    $only_inStock = true;
}

if(count($error) == 0){
    $result = Results::getResults($mobile, $brand, $min, $max, $sort, $only_inStock);
}

$resultCount = count($result);

if($sort == "ASC"){
    usort($result, function($a, $b) {
        return $a['price_int'] <=> $b['price_int'];
    });
}
else{
    usort($result, function($a, $b) {
        return $b['price_int'] <=> $a['price_int'];
    });
}


// show($result);


$groupedResults = [];

foreach ($result as $r) {
    $shop = $r['shop'];

    $groupedResults[$shop]['items'][] = $r;
    $groupedResults[$shop]['img'] = $r['img'];
    $groupedResults[$shop]['vendor_link'] = $r['vendor_link'] ?? "";
    $groupedResults[$shop]['vendor'] = $r['vendor'];
    $groupedResults[$shop]['logo'] = $r['logo'] ?? "";
    $groupedResults[$shop]['scraped'] = $r['scraped'];
    $groupedResults[$shop]['shop_logo'] = $r['shop_logo'] ?? "";
    $groupedResults[$shop]['vendor_id'] = $r['vendor_id'] ?? "";


}

// show($groupedResults);


include("app/views/results.view.php");