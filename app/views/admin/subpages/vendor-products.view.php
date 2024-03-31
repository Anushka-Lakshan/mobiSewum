<main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-5">
    <div class="dashboard-header">
        <h1 class="h2">Vendor Products</h1>
        <p>Manage the Vendor Products</p>
    </div>


    <?php 

        include "app/models/VendorProducts.model.php";
        include_once "app/models/Vendor.model.php";
        include_once "app/models/Shop.model.php";

        $products = VendorProducts::get_all();

        $vendors = Vendor::get_all();

        $shops = Shop::get_all();

        // show($Products);

        // show($Vendors);

        // show($Shops);


?>

<?php
function getVendorName($vendorId, $vendors) {
    foreach ($vendors as $vendor) {
        if ($vendor['id'] == $vendorId) {
            return $vendor['username'];
        }
    }
    return 'Unknown';
}

function getShopName($shopId, $shops) {
    foreach ($shops as $shop) {
        if ($shop['id'] == $shopId) {
            return $shop['name'];
        }
    }
    return 'Unknown';
}
?>

    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Vendor Name</th>
            <th>Shop Name</th>
            <th>Actions</th>
        </tr>
            </thead>


            <tbody>

                
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><img src="<?=BASE_URL?>/assets/images/mobile-images/<?= $product['img'] ?>" alt="" width="50px"></td>
                <td><?php echo getVendorName($product['vendor_id'], $vendors); ?></td>
                <td><?php echo getShopName($product['shop'], $shops); ?></td>
                <td>
                    <a href="<?=BASE_URL?>/admin-dashboard?page=edit-vendor-product&id=<?= $product['id'] ?>" class="btn btn-warning">Edit</a>
                    <button class="btn btn-danger" onclick="delete_mobile(<?= $product['id'] ?>)">Delete</button>
                </td>
                
            </tr>
        <?php endforeach; ?>
                
            </tbody>
        </table>
    </div>

    

    
    


    <script>
        function delete_mobile(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= BASE_URL ?>/vendor/AJAX/delete_mobile',
                type: 'POST',
                data: {
                    m_id: id
                },
                success: function(data) {
                    // Check the response from the server
                    if (data.success) {
                        Swal.fire('Success', 'Mobile deleted successfully', 'success').then(() => {
                            window.location.reload();
                        })
                    }
                    else {
                        Swal.fire('Failed', data.message, 'error');
                        console.log(data);
                    }
                },
                error: function(data) {
                    Swal.fire('Error', 'An error occurred while submitting the form', 'error');
                    console.log(data);
                }
            });

            Swal.close();
        }

        });


        
    }

    </script>

</main>