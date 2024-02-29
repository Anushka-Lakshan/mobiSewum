<?php

use Goutte\Client;

function main_genius_mobile()
{

// Initialize Goutte
$client = new Client();

// URL of the site to scrape
$url = 'https://geniusmobile.lk/shop/mobile-phones/';

// Array to store scraped data
$productsData = [];

$count = 0;

do {
    // Send a request to the URL
    $crawler = $client->request('GET', $url);

    // Extract product data
    $crawler->filter('.products li.product')->each(function ($product) use (&$productsData, &$count) {
        
        $isOutOfStock = $product->filter('.product.outofstock')->count() > 0;

        // If out of stock, you may set $instock to false
        $instock = !$isOutOfStock;
        
        $productName = $product->filter('h2 a')->text();
        $price = $product->filter('.woocommerce-Price-amount');
        
        $imgUrl = $product->filter('.mf-product-thumbnail img')->attr('src');
        $productUrl = $product->filter('h2 a')->attr('href');
        $shop = 'Genius Mobile';

        $DecimalPrice = 0;

        if($price->count() > 0){
            $price = $price->text();
            $price = str_replace('රු', 'Rs.', $price);
            $DecimalPrice = productPriceToDecimal($price);
        }else{
            $price = 'No price found';
        }

        // Store the data in the array
        $productsData[] = [
            'title' => $productName,
            'price' => $price,
            'decimal_price' => $DecimalPrice,
            'img_url' => $imgUrl,
            'product_url' => $productUrl,
            'shop' => $shop,
            'instock' => $instock
        ];

        $count++;
    });

    usleep(500000);

    // Check if there is a next page
    $nextPageLink = $crawler->filter('.woocommerce-pagination a.next');
    if ($nextPageLink->count() > 0) {
        $url = $nextPageLink->attr('href');
    } else {
        // No more pages, exit the loop
        break;
    }

} while (true);

echo $count . ' records found from geniusmobile <br>';

// Save the scraped data to a CSV file

$csvFileName = 'scraped_data.csv';

$csvFile = fopen($csvFileName, 'a');


foreach ($productsData as $product) {
    fputcsv($csvFile, $product);
}


fclose($csvFile);


echo "Data has been scraped from geniusmobile and appended to '$csvFileName' successfully.<br>";

}

?>
