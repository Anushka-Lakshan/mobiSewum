<?php

use Goutte\Client;



function main_celltronics()
{
    // celltronics.php

    $client = new Client();

    $csvFileName = 'scraped_data.csv';

    $csvFile = fopen($csvFileName, 'a');

    $products2 = [];

    $count = 0;


    $crawler = $client->request('GET', 'https://celltronics.lk/product-category/mobile-phones-price-in-sri-lanka/?per_page=256');


    $crawler->filter('.product')->each(function ($node) use (&$count, &$products2) {
        // Check if the product is out of stock
        $isOutOfStock = $node->filter('span.out-of-stock')->count() > 0;

        // If out of stock, you may set $instock to false
        $instock = !$isOutOfStock;

        // Rest of your code...
        $title = $node->filter('.wd-entities-title')->text();
        $img = $node->filter('img.attachment-woocommerce_thumbnail');
        $price = $node->filter('.woocommerce-Price-amount');
        $DecimalPrice = 0;

        if($price->count() > 0){
            $price = $price->text();
            $DecimalPrice = productPriceToDecimal($price);
        }else{
            $price = 'No price found';
        }

        
        $link = $node->filter('.wd-entities-title > a')->attr('href');
        $shop = 'Celltronics';

        if ($img->count() > 0) {
            $img = $img->attr('data-wood-src');
        } else {
            $img = 'No image found';
        }

        $products2[] = [
            'title' => $title,
            'price' => $price,
            'DecimalPrice' => $DecimalPrice,
            'img' => $img,
            'link' => $link,
            'shop' => $shop,
            'instock' => $instock, // Include the instock information in the product array
        ];

        $count++;
    });

    $crawler = $client->request('GET', 'https://celltronics.lk/product-category/mobile-phones-price-in-sri-lanka/page/2/?per_page=256');

    $crawler->filter('.product')->each(function ($node) use (&$count, &$products2) {
        // Check if the product is out of stock
        $isOutOfStock = $node->filter('span.out-of-stock')->count() > 0;

        // If out of stock, you may set $instock to false
        $instock = !$isOutOfStock;

        // Rest of your code...
        $title = $node->filter('.wd-entities-title')->text();
        $img = $node->filter('img.attachment-woocommerce_thumbnail');
        $price = $node->filter('.woocommerce-Price-amount');
        $DecimalPrice = 0;

        if($price->count() > 0){
            $price = $price->text();
            $DecimalPrice = productPriceToDecimal($price);
        }else{
            $price = 'No price found';
        }

        
        $link = $node->filter('.wd-entities-title > a')->attr('href');
        $shop = 'Celltronics';

        if ($img->count() > 0) {
            $img = $img->attr('data-wood-src');
        } else {
            $img = 'No image found';
        }

        $products2[] = [
            'title' => $title,
            'price' => $price,
            'DecimalPrice' => $DecimalPrice,
            'img' => $img,
            'link' => $link,
            'shop' => $shop,
            'instock' => $instock, // Include the instock information in the product array
        ];

        $count++;
    });

    

    echo $count . ' records found from Celltronics <br>';

    foreach ($products2 as $product) {
        fputcsv($csvFile, $product);
    }



    // Close the CSV file
    fclose($csvFile);

    echo "Data has been scraped and appended to '$csvFileName' successfully.<br>";
}

?>
