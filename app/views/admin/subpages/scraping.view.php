<main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-4">
    
    <div class="row py-3 justify-content-center">
        <div class="col-4">
            <button class="btn btn-lg btn-danger">Initialize Product Scraping</button>
        </div>
        <div class="col-4">
        <button class="btn btn-lg btn-success" onclick="getScrapedProducts()">View Scraped Products</button>
        </div>
        <div class="col-4">
        <button class="btn btn-lg btn-warning" onclick="getScrapedRecords()">View Scraped Records</button>
        </div>
    </div>

    <div id="Content_pane" class="py-3" ></div>

    <script>
        function getScrapedProducts() {
            $.ajax({
                url: "<?= BASE_URL ?>/admin/AJAX/getScrapedProducts",
                success: function(data) {
                    $("#Content_pane").html(data);

                },
                error: function() {
                    Swal.fire('Error', 'Error retrieving data', 'error');
                }
            })
        }

        function getScrapedRecords() {
            $.ajax({
                url: "<?= BASE_URL ?>/admin/AJAX/getScrapedRecords",
                success: function(data) {
                    $("#Content_pane").html(data);
                },
                error: function() {
                    Swal.fire('Error', 'Error retrieving data', 'error');
                }
            })
        }
    </script>


</main>