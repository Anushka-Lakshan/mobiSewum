<?php

use Goutte\Client;



function main_dialcom()
{
    // lifeMobile.php

    $client = new Client();

    $products = [];

    $count = 0;

    $csvFileName = 'scraped_data.csv';

    $csvFile = fopen($csvFileName, 'a');


    $crawler = $client->request('GET', 'https://dialcom.lk/product-category/mobile-accessories/mobile-phones/?per_page=200');


    $crawler->filter('.product')->each(function ($node) use (&$products, &$count) {

        // Check if the product is out of stock
        $isOutOfStock = $node->filter('.product.outofstock')->count() > 0;

        // If out of stock, you may set $instock to false
        $instock = !$isOutOfStock;

        $title = $node->filter('.wd-entities-title > a')->text();
        $price = $node->filter('.woocommerce-Price-amount');
        $DecimalPrice = 0;
        $img = $node->filter('img.attachment-woocommerce_thumbnail')->attr('src');
        $link = $node->filter('a.product-image-link')->attr('href');
        $shop = 'Dialcom';
    
        if($price->count() > 0){
            $price = $price->text();
            $price = str_replace('LKR', 'Rs.', $price);
            $DecimalPrice = productPriceToDecimal($price);
        }else{
            $price = 'No price found';
        }
    
        $count++;
    
        $products[] = [
            'title' => $title,
            'price' => $price,
            'DecimalPrice' => $DecimalPrice,
            'img' => $img,
            'link' => $link,
            'shop' => $shop,
            'instock' => $instock,
        ];
    });


    echo $count . ' records found from Dialcom <br>';

    foreach ($products as $product) {
        fputcsv($csvFile, $product);
    }



    // Close the CSV file
    fclose($csvFile);

    echo "Data has been scraped and appended to '$csvFileName' successfully. <br>";
}
