<?php

include "app/models/admin.model.php";

$admin = new Admin();

$tableData = $admin->get_all();

?>
<main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-3">Manage Admins</h2>
            <button class="btn btn-primary" onclick="Add_Admin()">Add Admin</button>
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($tableData as $key => $value) {
                            echo "<tr>";
                            echo "<td>" . $value['id'] . "</td>";
                            echo "<td>" . $value['name'] . "</td>";
                            echo "<td>" . $value['username'] . "</td>";

                            echo "<td>
                                        <button class='btn btn-warning' onclick='edit_Admin(" . $value['id'] . ",\"" . $value['username'] . "\",\"" . $value['name'] . "\")'> Edit User </button>
                                        <button class='btn btn-danger' onclick='delete_Admin(" . $value['id'] . " ,\"" . $value['username'] . "\")'> remove user </button>
                                    </td>";
                            echo "</tr>";
                        }
                        ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</main>

<script>
    function Add_Admin(un = '', name = '', pass = '', cpass = '') {
        Swal.fire({
            title: 'Add New Admin',
            html: `
            <form id="myForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputField1">User Name</label>
                    <input type="text" id="inputField1" value="${un}" placeholder="Enter User Name" required>
                </div>
                <div class="form-group">
                    <label for="inputField2">Name</label>
                    <input type="text" id="inputField2" value="${name}" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <label for="inputField3">Password</label>
                    <input type="password" id="inputField3" value="${pass}" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                    <label for="inputField4">Confirm Password</label>
                    <input type="password" id="inputField4" value="${cpass}" placeholder="Enter Password Again" required>
                </div>
                
            </form>`,
            showCancelButton: true,
            confirmButtonText: 'Submit',
        }).then((result) => {
            if (result.isConfirmed) {
                const username = document.getElementById('inputField1').value;
                const name = document.getElementById('inputField2').value;
                const password = document.getElementById('inputField3').value;
                const confirmPassword = document.getElementById('inputField4').value;

                // Validate input field
                if (!username || !name || !password || !confirmPassword) {
                    Swal.fire('Error', 'Please fill in all fields!', 'error');

                    return;
                }

                // Validate password
                if (password !== confirmPassword) {
                    Swal.fire('Error', 'Passwords do not match!', 'error');

                    return;
                }


                // Use FormData to handle file upload
                let formData = new FormData();
                formData.append('username', username);
                formData.append('name', name);
                formData.append('password', password);


                $.ajax({
                    url: '<?= BASE_URL ?>/admin/AJAX/add_admin',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // Check the response from the server
                        if (data.success) {
                            Swal.fire('Success', 'Admin added successfully', 'success').then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire('Failed', data.message[0], 'error');
                            console.log(data);
                        }
                    },
                    error: function(data) {
                        Swal.fire('Error', 'An error occurred while submitting the form', 'error');
                        console.log(data.responseText);
                    }
                });

                // Close the SweetAlert2 modal
                Swal.close();
            }
        });
    }

    function edit_Admin(id, username, name) {
        Swal.fire({
            title: 'Edit Admin',
            html: `
            <form id="myForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputField1">User Name</label>
                    <input type="text" id="inputField1" value="${username}" placeholder="Enter User Name" required>
                </div>
                <div class="form-group">
                    <label for="inputField2">Name</label>
                    <input type="text" id="inputField2" value="${name}" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <label for="inputField3">Password</label>
                    <input type="password" id="inputField3" value="" placeholder="Enter new Password" required>
                </div>
                <div class="form-group">
                    <label for="inputField4">Confirm Password</label>
                    <input type="password" id="inputField4" value="" placeholder="Enter Password Again" required>
                </div>
                
            </form>`,
            showCancelButton: true,
            confirmButtonText: 'Submit',
        }).then((result) => {
            if (result.isConfirmed) {
                const username = document.getElementById('inputField1').value;
                const name = document.getElementById('inputField2').value;
                const password = document.getElementById('inputField3').value;
                const confirmPassword = document.getElementById('inputField4').value;

                // Validate input field
                if (!username || !name || !password || !confirmPassword) {
                    Swal.fire('Error', 'Please fill in all fields!', 'error');
                    return;
                }

                // Validate password
                if (password !== confirmPassword) {
                    Swal.fire('Error', 'Passwords do not match!', 'error');
                    return;
                }


                // Use FormData to handle file upload
                let formData = new FormData();
                formData.append('id', id);
                formData.append('username', username);
                formData.append('name', name);
                formData.append('password', password);


                $.ajax({
                    url: '<?= BASE_URL ?>/admin/AJAX/edit_admin',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // Check the response from the server
                        if (data.success) {
                            Swal.fire('Success', 'Admin edited successfully', 'success').then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire('Failed', data.message, 'error');
                            console.log(data);
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', 'An error occurred while submitting the form', 'error');
                        console.log(xhr); // Log the entire xhr object for debugging
                    }
                });

                // Close the SweetAlert2 modal
                Swal.close();
            }
        });
    }

    function delete_Admin(id, uname) {
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
                url: '<?= BASE_URL ?>/admin/AJAX/delete_admin',
                type: 'POST',
                data: {
                    id: id,
                    username: uname
                },
                success: function(data) {
                    // Check the response from the server
                    if (data.success) {
                        Swal.fire('Success', 'Admin deleted successfully', 'success').then(() => {
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