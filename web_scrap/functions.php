<?php

function productPriceToDecimal($productPriceString){

// Remove non-numeric characters (keep only digits and a dot)
$productPriceString = str_replace('Rs.', '', $productPriceString);
$numericString = preg_replace("/[^0-9.]/", "", $productPriceString);

// Convert the numeric string to a float value
$productPriceDecimal = floatval($numericString);

// Print the result
return $productPriceDecimal;


}








?>
