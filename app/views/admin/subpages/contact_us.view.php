<main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-5">
    <div class="dashboard-header">
        <h1 class="h2">Contact us</h1>
        <p>View Contact us messages</p>
    </div>

    

    <?php 

        include "app/models/Contact.model.php";

        $all = Contact::get_all();

        // show($all);


?>

    <div class="table-responsive">

        <table id="dataTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($all as $contact): ?>
        <tr>
            <td><?= $contact['id'] ?></td>
            <td><?= $contact['name'] ?></td>
            <td><?= $contact['email'] ?></td>
            <td><?= $contact['tel'] ?></td>
            <td><?= $contact['msg'] ?></td>
            <td>
                <?php if ($contact['vendor_id'] > 0): ?>
                    <a href="<?= BASE_URL ?>/admin-dashboard?page=view_shop&id=<?= $contact['vendor_id'] ?>" class="btn btn-primary">View Shop</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


    </div>

    

    
    


    <script>
        // Function to Add Brand
        function Add_brand() {
            Swal.fire({
                title: 'Add New Brand',
                html: `
            <form id="myForm" enctype="multipart/form-data">
                <div class="form-group">
                <label for="inputField">Brand Name</label>
                <input type="text" id="inputField" placeholder="Enter Brand Name" required>
                </div>
                <input type="file" id="imageField" accept="image/png, image/jpeg, image/jpg" required>
            </form>`,
                showCancelButton: true,
                confirmButtonText: 'Submit',
            }).then((result) => {
                if (result.isConfirmed) {
                    const inputFieldValue = document.getElementById('inputField').value;
                    const imageFile = document.getElementById('imageField').files[0];

                    // Validate input field
                    if (!inputFieldValue) {
                        Swal.fire('Error', 'Please enter a brand name', 'error');
                        return;
                    }

                    // Validate image file
                    if (!imageFile) {
                        Swal.fire('Error', 'Please select an image file', 'error');
                        return;
                    }

                    // Use FormData to handle file upload
                    let formData = new FormData();
                    formData.append('brand_name', inputFieldValue);
                    formData.append('brand_logo', imageFile);

                    $.ajax({
                        url: '<?= BASE_URL ?>/admin/AJAX/add_brand',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            // Check the response from the server
                            if (data.success) {
                                Swal.fire('Success', 'Brand added successfully', 'success').then(() => {
                                    window.location.reload();
                                })
                            } else {
                                Swal.fire('Failed', 'Brand could not be added', 'error');
                                console.log(data);
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'An error occurred while submitting the form', 'error');
                            console.log(data);
                        }
                    });

                    // Close the SweetAlert2 modal
                    Swal.close();
                }
            });
        }

        // Function to Edit Brand
        function EditBrand(id, name, logo) {
            Swal.fire({
                title: 'Edit Brand',
                html: `
            <form id="myForm" enctype="multipart/form-data">
                <div class="form-group">
                <label for="inputField">Brand Name</label>
                <input type="text" id="inputField" placeholder="Enter Brand Name" value="${name}" required>
                </div>
                <p>Old photo</p>
                <img src="./assets/images/brands/${logo}" alt="" width="80px" height="80px" style="object-fit: contain;">
                <br>
                <p>Enter New photo</p>
                <input type="file" id="imageField" accept="image/png, image/jpeg, image/jpg" required>
            </form>`,
                showCancelButton: true,
                confirmButtonText: 'Submit',
            }).then((result) => {
                if (result.isConfirmed) {
                    const inputFieldValue = document.getElementById('inputField').value;
                    const imageFile = document.getElementById('imageField').files[0];

                    // Validate input field
                    if (!inputFieldValue) {
                        Swal.fire('Error', 'Please enter a brand name', 'error');
                        return;
                    }

                    // Validate image file
                    if (!imageFile) {
                        Swal.fire('Error', 'Please select an image file', 'error');
                        return;
                    }

                    // Use FormData to handle file upload
                    let formData = new FormData();
                    formData.append('id', id);
                    formData.append('brand_name', inputFieldValue);
                    formData.append('brand_logo', imageFile);

                    $.ajax({
                        url: '<?= BASE_URL ?>/admin/AJAX/edit_brand',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            // Check the response from the server
                            if (data.success) {
                                Swal.fire('Success', 'Brand edit successfully', 'success').then(() => {
                                    window.location.reload();
                                })
                            } else {
                                Swal.fire('Failed', 'Brand could not be edited', 'error');
                                console.log(data);
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'An error occurred while submitting the form', 'error');
                            console.log(data);
                        }
                    });

                    // Close the SweetAlert2 modal
                    Swal.close();
                }
            });
        }

        // Function to Delete Brand
        function DeleteBrand(id) {
                        Swal.fire({
                            title: 'Are you sure? You want to delete this Brand?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#ff6347',
                            cancelButtonColor: '#48c28d',
                            confirmButtonText: 'Yes, delete it!'

                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Perform actions with the form data, e.g., make an AJAX request
                                $.ajax({
                                    url: '<?=BASE_URL?>/admin/AJAX/delete_brand',
                                    type: 'POST',
                                    data: { brand_id: id },
                                    success: function (data) {
                                        // Check the response from the server
                                        if (data.success) {
                                            Swal.fire('Success', 'Brand deleted successfully', 'success').then(() => {
                                                window.location.reload();
                                            })
                                        } else {
                                            Swal.fire('Failed', 'Brand could not be deleted', 'error');
                                            console.log(data);
                                        }
                                    },
                                    error: function () {
                                        Swal.fire('Error', 'An error occurred while submitting the form', 'error');
                                        console.log(data);
                                    }
                                });
                            }
                        })
                    }
        
    </script>

</main>