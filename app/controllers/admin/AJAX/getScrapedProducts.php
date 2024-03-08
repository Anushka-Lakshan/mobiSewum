<?php

if(!isset($_SESSION['admin_name'])){
    header("Location: ".BASE_URL."/admin-login");
    die;
    
}


include "app/models/scrapedProducts.model.php";

$scrapedProducts = ScrapedProducts::get_all();

// show($scrapedProducts);

?>


<div class="row" style="width: 100%;">
<h2 class="text-center mb-3">Scraped Products</h2>
    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Mobile Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Link</th>
                    <th>Shop</th>
                    <th>In Stock</th>
                </tr>
            </thead>


            <tbody>

                <?php
                foreach ($scrapedProducts as $Pro) {
                ?>
                    <tr>
                        <td><?= $Pro['id'] ?></td>
                        <td><?= $Pro['name'] ?></td>
                        <td><?= $Pro['price'] ?></td>
                        <td><img src="<?= $Pro['img'] ?>" alt="" width="50px"></td>
                        <td><a href="<?= $Pro['link'] ?>" target="_blank"><?= $Pro['link'] ?></a></td>
                        <td><?= $Pro['shop'] ?></td>
                        <td><?= $Pro['in_stock'] == 1 ? "Yes" : "No" ?></td>

                    </tr>

                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<script>
    $('#dataTable').DataTable({

        "paging": true,
        "autoWidth": true,
        "buttons": [
            'colvis',
            'copyHtml5',
            'csvHtml5',
            'excelHtml5',
            'pdfHtml5',
            'print'
        ]
    });
</script>