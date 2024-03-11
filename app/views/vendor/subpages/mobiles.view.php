<?php


include "app/models/VendorProducts.model.php";

$Products = VendorProducts::get_all();

// show($scrapedProducts);

?>

<main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-4 pt-3 d-block">



    <div class="row" style="width: 100%;">
        <h2 class="text-center mb-3 d-block">Your Mobiles</h2>
        <div>

            <button class="btn btn-primary mb-3 ml-3 d-block" style="display: block;" onclick="window.location.href='<?= BASE_URL ?>/vendor-dashboard?page=add_mobile'">Add Mobile</button>
        </div>

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
                    foreach ($Products as $Pro) {
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
</main>