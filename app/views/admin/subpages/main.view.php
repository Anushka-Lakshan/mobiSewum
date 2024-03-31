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
        <p>Site Administrator dashboard.</p>
    </div>
    <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card bg-primary">
                    <a href="<?= BASE_URL ?>/admin-dashboard" class="card-link text-light">
                        <i class="fas fa-chart-line fa-3x mr-3"></i>
                        Dashboard
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-secondary">
                    <a href="<?= BASE_URL ?>/admin-dashboard?page=brands" class="card-link text-light">
                        <i class="fas fa-tags fa-3x mr-3"></i>
                        Brands
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-info">
                    <a href="<?= BASE_URL ?>/admin-dashboard?page=scraping" class="card-link text-light">
                        <i class="fas fa-cogs fa-3x mr-3"></i>
                        Scraped Products
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-warning">
                    <a href="<?= BASE_URL ?>/admin-dashboard?page=vendor-products" class="card-link text-light">
                        <!-- <i class="fas fa-cogs fa-3x mr-3"></i> -->
                        <!-- <i class="fa-solid fa-mobile-screen"></i> -->
                        <i class="fas fa-mobile fa-3x mr-3"></i>
                        Vendor Products
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-danger">
                    <a href="<?= BASE_URL ?>/admin-dashboard?page=online-vendors" class="card-link text-light">
                        <!-- <i class="fas fa-cogs fa-3x mr-3"></i> -->
                        <i class="fas fa-user-friends fa-3x mr-3"></i>
                        Online Vendors
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-dark">
                    <a href="<?= BASE_URL ?>/admin-dashboard?page=shops" class="card-link text-light">
                        <!-- <i class="fas fa-cogs fa-3x mr-3"></i> -->
                        <i class="fas fa-store-alt fa-3x mr-3"></i>
                        Registered Shops
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-info">
                    <a href="<?= BASE_URL ?>/admin-dashboard?page=admins" class="card-link text-light">
                        <!-- <i class="fas fa-cogs fa-3x mr-3"></i> -->
                        <i class="fas fa-crown fa-3x mr-3"></i>
                        Admins
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-success">
                    <a href="<?= BASE_URL ?>/admin-dashboard?page=contact_us" class="card-link text-light">
                        <!-- <i class="fas fa-cogs fa-3x mr-3"></i> -->
                        <i class="fas fa-mail-bulk fa-3x mr-3"></i>
                        Contact us
                    </a>
                </div>
            </div>
            <!-- Add more cards for other admin functions -->
        </div>
</main>