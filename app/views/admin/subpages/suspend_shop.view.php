<main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="dashboard-header">
        <h1 class="h2">Shop Suspended!</h1>
        <p><a href="<?= BASE_URL?>/admin-dashboard?page=shops">Go to Dashboard</a></p>
    </div>
    
    <?php

        $id = $_GET["id"];

        include_once "app/models/Shop.model.php";

        $result = Shop::suspend($id);

        if ($result) {
            echo "<h3>Shop suspended successfully!</h3>";
        }
        else {
            echo "<h3>Shop could not be suspended!</h3>";
        }

    ?>
</main>
