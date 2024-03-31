<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobisewum Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link href="./assets/js/datatables.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">
            <img src="<?= BASE_URL ?>/assets/images/logo.png" alt="Mobisewum Logo" width="60" height="30" class="d-inline-block align-top bg-white mr-2">
            Mobisewum Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="logout()" href="javascript:void(0)">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <script>
                  function logout() {
                    Swal.fire({
                      title: 'Do you want to log out?',
                      icon: 'question',
                      showCancelButton: true,
                      confirmButtonColor: '#FF0000', // Red color for "Yes"
                      confirmButtonText: 'Yes',
                      cancelButtonText: 'Cancel'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        // User clicked "Yes," redirect to /logout
                        window.location.href = '<?= BASE_URL ?>/admin-logout';
                      }
                    });
                  }
                </script>



    <div class="container-fluid main-container">
        <div class="row">
            <nav class="col-2 bg-dark text-white sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php if ($subpage == 'main') echo 'active'; ?>" href="<?= BASE_URL ?>/admin-dashboard">Dashboard <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($subpage == 'brands') echo 'active'; ?>" href="<?= BASE_URL ?>/admin-dashboard?page=brands">Brands</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($subpage == 'scraping') echo 'active'; ?>" href="<?= BASE_URL ?>/admin-dashboard?page=scraping">Scraped Products</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php if ($subpage == 'vendor-products') echo 'active'; ?>"  href="<?= BASE_URL ?>/admin-dashboard?page=vendor-products">Vendor Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($subpage == 'online-vendors') echo 'active'; ?> " href="<?= BASE_URL ?>/admin-dashboard?page=online-vendors"> Online Vendors</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link <?php if ($subpage == 'shops') echo 'active'; ?>" href="<?= BASE_URL ?>/admin-dashboard?page=shops">Registered Shops</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($subpage == 'admins') echo 'active'; ?>" href="<?= BASE_URL ?>/admin-dashboard?page=admins">Admins</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <?php

            if (isset($_SESSION['temp_msg'])) {
                echo '
                <script>
                    Swal.fire({
                        title: "' . $_SESSION['temp_msg'] . '",
                        text: "' . (isset($_SESSION['temp_msg_secondery']) ? $_SESSION['temp_msg_secondery'] : '') . '",
                        icon: "' . (isset($_SESSION['temp_msg_type']) ? $_SESSION['temp_msg_type'] : 'success') . '",
                        showCancelButton: false,
                        confirmButtonText: "Continue"
                    });
                </script>
                ';
                unset($_SESSION['temp_msg']);
                unset($_SESSION['temp_msg_secondery']);
                unset($_SESSION['temp_msg_type']);
            }

            ?>

            <?php include("app/views/admin/subpages/$subpage.view.php"); ?>


        </div>
    </div>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #12385e !important;
        }

        .navbar-dark {
            background-color: #12385e !important;
        }

        .main-container {
            padding-top: 60px !important;
        }

        .sidebar {
            height: 100vh;
            background-color: #12385e !important;
            padding: 20px;
            padding-top: 30px;
        }

        main {
            padding-left: 20px 40px !important;
            border-radius: 20px 0 0 20px;
            background-color: #fff;
        }

        .sidebar .nav-link {
            clip-path: polygon(0 0%, 90% 0, 100% 50%, 90% 100%, 0 100%, 10% 50%);
            padding: 10px 30px;
            text-align: center;
            margin-bottom: 10px;
            color: #fff;
        }

        .nav-link.active {
            color: #fff !important;
            background-color: black;

        }

        .dashboard-header {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>




    <!-- data table scripts -->
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.1/b-3.0.0/b-colvis-3.0.0/b-html5-3.0.0/b-print-3.0.0/datatables.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>


    <script src="./assets/js/datatables.min.js"></script>


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
</body>

</html>