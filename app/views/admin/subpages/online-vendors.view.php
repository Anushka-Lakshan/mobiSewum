<main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="dashboard-header">
        <h1 class="h2">Online Vendors</h1>
        <p>Manage online vendors</p>
    </div>

    <button type="button" class="btn btn-primary btn-sm mb-3" onclick="addOnlineVendor()">Add Online Vendor</button>

    <?php

    include "app/models/OnlineVendors.model.php";

    $allBrands = OnlineVendors::get_all();

    // show($allBrands);


    ?>

    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>shop</th>
                    <th>link</th>
                    <th>logo</th>
                    <th>Actions</th>
                </tr>
            </thead>


            <tbody>

                <?php
                foreach ($allBrands as $brand) {
                    echo
                    '<tr>
                        <td>' . $brand['id'] . '</td>
                        <td>' . $brand['name'] . '</td>
                        <td>' . $brand['shop'] . '</td>
                        <td> <a target="_blank" href="' . $brand['link'] . '">' . $brand['link'] . ' </a></td>
                        <td> <img src="' . BASE_URL . '/assets/images/company-logos/' . $brand['logo'] . '" width="100px"></td>
                        <td>
                            <button class="btn-warning btn" onclick="EditVendor(' . $brand['id'] . ', \'' . $brand['name'] . '\', \'' . $brand['shop'] . '\', \'' . $brand['link'] . '\' , \'' .  BASE_URL . '/assets/images/company-logos/' . $brand['logo'] . '\')">Edit</button>
                            <button class="btn-danger btn" onclick="DeleteVendor(' . $brand['id'] . ')">Delete</button>
                        </td>
                    </tr>';
                }
                ?>

            </tbody>
        </table>
    </div>








</main>


<script>
    function addOnlineVendor() {
        Swal.fire({
            title: 'Add Online vendor',
            html: `
            <form id="myForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputField">Vendor Name</label>
                    <input type="text" id="inputField" placeholder="Enter Vendor Name" required>
                </div>
                <div class="form-group">
                    <label for="inputField2">Shop name</label>
                    <input type="text" id="inputField2" placeholder="Enter Shop name" required>
                </div>
                <div class="form-group">
                    <label for="inputField3">Site Link</label>
                    <input type="text" id="inputField3" placeholder="Enter Site Link" required>
                </div>
                <div class="form-group">
                    <label for="imageField">Vendor Logo</label>
                    <input type="file" id="imageField" accept="image/png, image/jpeg, image/jpg" required>
                </div>
                
                
            </form>`,
            showCancelButton: true,
            confirmButtonText: 'Submit',
        }).then((result) => {
            if (result.isConfirmed) {
                const Vname = document.getElementById('inputField').value;
                const Vshop = document.getElementById('inputField2').value;
                const Vlink = document.getElementById('inputField3').value;
                const imageFile = document.getElementById('imageField').files[0];

                // Validate input field
                if (!Vname || !Vshop || !Vlink) {
                    Swal.fire('Error', 'Please enter all required fields', 'error');
                    return;
                }

                // Validate image file
                if (!imageFile) {
                    Swal.fire('Error', 'Please select an image file', 'error');
                    return;
                }

                // Use FormData to handle file upload
                let formData = new FormData();
                formData.append('name', Vname);
                formData.append('shop', Vshop);
                formData.append('link', Vlink);
                formData.append('logo', imageFile);

                $.ajax({
                    url: '<?= BASE_URL ?>/admin/AJAX/add_online_vendor',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // Check the response from the server
                        if (data.success) {
                            Swal.fire('Success', 'Online vendor added successfully', 'success').then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire('Failed', 'Online vendor could not be added', 'error');
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


    function EditVendor(id, name, shop, link, logo) {
        Swal.fire({
            title: 'Edit Online Vendor',
            html: `
            <form id="myForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputField">Vendor Name</label>
                    <input type="text" id="inputField" placeholder="Enter Vendor Name" value="${name}" required>
                </div>
                <div class="form-group">
                    <label for="inputField2">Shop Name</label>
                    <input type="text" id="inputField2" placeholder="Enter Shop Name" value="${shop}" required>
                </div>
                <div class="form-group">
                    <label for="inputField3">Site Link</label>
                    <input type="text" id="inputField3" placeholder="Enter Site Link" value="${link}" required>
                </div>
                <div class="form-group">
                    <p>Old Logo</p>
                    <img src="${logo}" alt="Old Logo" width="80px" height="80px" style="object-fit: contain;">
                    <p>Upload New Logo</p>
                    <input type="file" id="imageField" accept="image/png, image/jpeg, image/jpg">
                </div>
            </form>`,
            showCancelButton: true,
            confirmButtonText: 'Submit',
        }).then((result) => {
            if (result.isConfirmed) {
                const vendorName = document.getElementById('inputField').value;
                const shopName = document.getElementById('inputField2').value;
                const siteLink = document.getElementById('inputField3').value;
                const logoFile = document.getElementById('imageField').files[0];

                // Validate input field
                if (!vendorName || !shopName || !siteLink) {
                    Swal.fire('Error', 'Please enter all required fields', 'error');
                    return;
                }

                // Validate image file
                if (!logoFile) {
                    Swal.fire('Error', 'Please select an image file', 'error');
                    return;
                }

                // Use FormData to handle file upload
                let formData = new FormData();
                formData.append('id', id);
                formData.append('name', vendorName);
                formData.append('shop', shopName);
                formData.append('link', siteLink);
                if (logoFile) {
                    formData.append('logo', logoFile);
                }

                $.ajax({
                    url: '<?= BASE_URL ?>/admin/AJAX/edit_online_vendor',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.success) {
                            Swal.fire('Success', 'Online vendor edited successfully', 'success').then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Failed', 'Online vendor could not be edited', 'error');
                            console.log(data);
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'An error occurred while submitting the form', 'error');
                    }
                });

                // Close the SweetAlert2 modal
                Swal.close();
            }
        });
    }


    function DeleteVendor(id) {
        Swal.fire({
            title: 'Delete Online Vendor',
            text: "Are you sure you want to delete this online vendor?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= BASE_URL ?>/admin/AJAX/delete_online_vendor',
                    type: 'POST',
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        if (data.success) {
                            Swal.fire('Success', 'Online vendor deleted successfully', 'success').then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Failed', 'Online vendor could not be deleted', 'error');
                            console.log(data);
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'An error occurred while deleting the Online Vendor', 'error');
                    }
                });
            }
        });
    }

</script>