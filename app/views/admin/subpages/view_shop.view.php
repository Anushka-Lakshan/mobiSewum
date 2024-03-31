<main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-4">

<?php

    $id = $_GET['id'];

    include_once "app/models/Shop.model.php";

    $shop = Shop::get_shop_by_id($id);

    $shop = $shop[0];

?>
    
<div class="dashboard-header">
        <h1 class="h2">Shop details</h1>
        <a href="<?= BASE_URL ?>/admin-dashboard?page=shops">Go back</a>
    </div>
    <div class="dashboard-cards">
    <div class="form-group">
                    <label for="shopName">Shop Name:</label>
                    <input type="text" class="form-control" id="shopName" value="<?= $shop['name'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" value="<?= $shop['address'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="tel">Tel:</label>
                    <input type="tel" class="form-control" id="tel" value="<?= $shop['tel'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" value="<?= $shop['address'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="regNo">Registration No:</label>
                    <input type="text" class="form-control" id="regNo" value="<?= $shop['registration_no'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="logo">Logo:</label><br>
                    <img src="<?= BASE_URL?>/assets/images/business/logos/<?= $shop['logo'] ?>" alt="Shop Logo" class="img-thumbnail" style="max-width: 200px;">
                </div>
                <div class="form-group">
                    <label for="image">Image:</label><br>
                    <img src="<?= BASE_URL?>/assets/images/business/shops/<?= $shop['img'] ?>" alt="Shop Image" class="img-thumbnail" style="max-width: 200px;">
                </div>
                <div class="form-group">
                    <label for="approved">Approved:</label>
                    <input type="text" class="form-control" id="approved" value="<?= $shop['approved'] ? 'Yes' : 'No' ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="suspended">Suspended:</label>
                    <input type="text" class="form-control" id="suspended" value="<?= $shop['suspended'] ? 'Yes' : 'No' ?>" readonly>
                </div>
    </div>
    


</main>