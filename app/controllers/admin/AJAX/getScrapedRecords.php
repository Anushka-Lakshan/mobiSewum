<?php

if(!isset($_SESSION['admin_name'])){
    header("Location: ".BASE_URL."/admin-login");
    die;
    
}


include "app/models/scrapedProducts.model.php";

$scrapedRecords = ScrapedProducts::get_Records();

// show($scrapedProducts);

?>


<div class="row" style="width: 100%;">
    <h2 class="text-center mb-3">Scraped Records</h2>
    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date and Time</th>
                    <th>Data File</th>
                    <th>Process Status</th>
                    
                </tr>
            </thead>


            <tbody>

                <?php
                foreach ($scrapedRecords as $record) {
                ?>
                    <tr>
                        <td><?= $record["id"] ?></td>
                        <td><?= $record["DateTime"] ?></td>
                        <td>
                            <a href="<?=BASE_URL?>/web_scrap/scraped_data/<?= $record["file_name"] ?>" target="_blank" rel="noopener noreferrer">
                                <?= $record["file_name"] ?>
                            </a>
                        </td>
                        <td><?= $record["status"] ?></td>

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