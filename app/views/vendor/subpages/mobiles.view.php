<?php


include "app/models/VendorProducts.model.php";

$Products = VendorProducts::get_by_vendor($_SESSION['Vendor_id']);



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
                        <!-- <th>Link</th> -->
                        <!-- <th>Shop</th> -->
                        <th>In Stock</th>
                        <th>Action</th>
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
                            <td><img src="<?=BASE_URL?>/assets/images/mobile-images/<?= $Pro['img'] ?>" alt="" width="50px"></td>
                            
                            <td><?= $Pro['in_stock'] == 1 ? "Yes" : "No" ?></td>
                            <td> 
                                <button class="btn btn-primary" onclick="window.location.href='<?= BASE_URL ?>/vendor-dashboard?page=edit_mobile&id=<?= $Pro['id'] ?>'">Edit</button>
                                <button class="btn btn-danger" onclick="delete_mobile(<?= $Pro['id'] ?>)">Delete</button>
                            </td>

                        </tr>

                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
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