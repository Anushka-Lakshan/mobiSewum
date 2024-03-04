<?php

use Goutte\Client;



function main_Idealz()
{
    // Ideals.php

    $client = new Client();

    $csvFileName = 'scraped_data.csv';

    $csvFile = fopen($csvFileName, 'a');

    $crawler = $client->request('GET', 'https://idealz.lk/product-category/smartphones-tablets/smartphones/');

    $form = $crawler->filter('form.form-techmarket-wc-ppp:nth-child(1)')->form(); // Select the form by its submit button or other criteria if available

    // Fill in the form with the desired value (-1 in this case)
    $form['ppp'] = '-1';

    usleep(50000);

    // Submit the form
    $crawler = $client->submit($form);

    $products2 = [];

    $count = 1;





    $crawler->filter('.tab-content > .active .products > .product')->each(function ($node) use (&$count, &$products2) {
        // Check if the product is out of stock
        $isOutOfStock = $node->filter('.product.outofstock')->count() > 0;

        // If out of stock, you may set $instock to false
        $instock = !$isOutOfStock;

        // Rest of your code...
        if ($node->filter('.woocommerce-loop-product__title')->count() > 0) {
            $title = $node->filter('.woocommerce-loop-product__title')->text();
        }
        else{
            $title = 'No title found';
        }

        $img = $node->filter('img.attachment-woocommerce_thumbnail');

        // Get the price

        $price = 'No price found';
        $DecimalPrice = 0;

        if ($node->filter('.price .woocommerce-Price-amount:nth-child(1) > bdi')->count() > 0) {
            $unicodeString = $node->filter('.price .woocommerce-Price-amount:nth-child(1) > bdi')->text();
            $price = str_replace('රු', 'Rs.', $unicodeString);
            $DecimalPrice = productPriceToDecimal($price);
        }
        
        
        $link = $node->filter('a.woocommerce-LoopProduct-link')->attr('href');
        $shop = 'Idealz';

        if ($img->count() > 0) {
            $img = $img->attr('src');
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


    echo $count . ' records found from Idealz Lanka <br>';

    foreach ($products2 as $product) {
        fputcsv($csvFile, $product);
    }



    // Close the CSV file
    fclose($csvFile);

    echo "Data has been scraped and appended to '$csvFileName' successfully.<br>";
}
