<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobisewum Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">
            <img src="<?=BASE_URL?>/assets/images/logo.png" alt="Mobisewum Logo" width="60" height="30" class="d-inline-block align-top bg-white mr-2">
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
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid main-container">
        <div class="row">
            <nav class="col-2 bg-dark text-white sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Dashboard <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Customers</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="dashboard-header">
                    <h1 class="h2">Dashboard</h1>
                    <p>This is a simple dashboard.</p>
                </div>
                <div class="dashboard-cards">
                    <div class="dashboard-card">Card 1</div>
                    <div class="dashboard-card">Card 2</div>
                    <div class="dashboard-card">Card 3</div>
                </div>
                <table class="table-dashboard">
                    <tr>
                        <th>Column 1</th>
                        <th>Column 2</th>
                        <th>Column 3</th>
                    </tr>
                    <tr>
                        <td>Data 1</td>
                        <td>Data 2</td>
                        <td>Data 3</td>
                    </tr>
                    <tr>
                        <td>Data 4</td>
                        <td>Data 5</td>
                        <td>Data 6</td>
                    </tr>
                </table>
            </main>
        </div>
    </div>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #12385e !important;
        }

        .navbar-dark{
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

        .nav-link.active{
            color: #fff !important;
            background-color: black;
            
        }

        .dashboard-header {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
        }

        .dashboard-card {
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .table-dashboard {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table-dashboard th,
        .table-dashboard td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table-dashboard th {
            background-color: #f8f9fa;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>