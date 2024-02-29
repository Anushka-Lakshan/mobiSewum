<?php

use Goutte\Client;



function main_lifemobile()
{
    // lifeMobile.php

    $client = new Client();

    $csvFileName = 'scraped_data.csv';

    $csvFile = fopen($csvFileName, 'a');

    $crawler = $client->request('GET', 'https://lifemobile.lk/product-category/mobile-phones/');

    $form = $crawler->filter('form.form-electro-wc-ppp')->form(); // Select the form by its submit button or other criteria if available

    // Fill in the form with the desired value (-1 in this case)
    $form['ppp'] = '-1';

    usleep(500000);

    // Submit the form
    $crawler = $client->submit($form);

    $products2 = [];

    $count = 1;





    $crawler->filter('li.product')->each(function ($node) use (&$count, &$products2) {
        // Check if the product is out of stock
        $isOutOfStock = $node->filter('li.product.outofstock')->count() > 0;

        // If out of stock, you may set $instock to false
        $instock = !$isOutOfStock;

        // Rest of your code...
        $title = $node->filter('.woocommerce-loop-product__title')->text();
        $img = $node->filter('img.attachment-woocommerce_thumbnail');
        $price = $node->filter('.woocommerce-Price-amount')->text();
        $DecimalPrice = productPriceToDecimal($price);
        $link = $node->filter('a.woocommerce-LoopProduct-link')->attr('href');
        $shop = 'Lifemobile';

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


    echo $count . ' records found from Lifemobile <br>';

    foreach ($products2 as $product) {
        fputcsv($csvFile, $product);
    }



    // Close the CSV file
    fclose($csvFile);

    echo "Data has been scraped and appended to '$csvFileName' successfully.<br>";
}
