<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        .card {
            height: 200px;
        }

        .card-link {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            text-decoration: none;
        }
    </style>
<main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="dashboard-header">
        <h1 class="h2">Dashboard</h1>
        <p>Vendor dashboard.</p>
    </div>
    <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card bg-danger">
                    <a href="<?= BASE_URL ?>/vendor-dashboard?page=mobiles" class="card-link text-light">
                        <i class="fas fa-chart-line fa-3x mr-3"></i>
                        Manage Mobiles
                    </a>
                </div>
            </div>
            
            <!-- Add more cards for other admin functions -->
        </div>
</main>