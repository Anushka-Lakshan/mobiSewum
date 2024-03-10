<main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-4">
    
    <div class="row py-3 justify-content-center">
        <div class="col-3">
            <button class="btn btn-md btn-danger" onclick="run_scrap()">Initialize Product Scraping</button>
        </div>
        <div class="col-3">
        <button class="btn btn-md btn-success" onclick="getScrapedProducts()">View Scraped Products</button>
        </div>
        <div class="col-3">
        <button class="btn btn-md btn-warning" onclick="getScrapedRecords()">View Scraped Records</button>
        </div>
        <div class="col-3">
        <button class="btn btn-md btn-info" onclick="window.location.href='<?= BASE_URL ?>/add_to_database'">Add products to database</button>
        </div>
    </div>

    <div id="Content_pane" class="py-3" ></div>

    <script>
        function run_scrap() {
            Swal.fire({
            title: 'Do you want to initialize scraping?',
            text: "This process will take some time. Please do not refresh the page.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, initialize it!'
        }).then((result) => {
        if (result.isConfirmed) {
            
            window.location.href = "<?= BASE_URL ?>/run-scrap";
            Swal.close();
        }

        });


        }


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