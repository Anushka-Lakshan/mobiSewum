<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>Mobisewum : Browse By Brand</title>
</head>

<body>
    <div class="result-header">
        <div class="container-nav">
            <header class="site-header">
                <div class="header__content--flow">
                    
                    <?php require 'partials/top_nav.view.php'; ?>
                </div>
            </header>
        </div>

        <div class="container">

            <h1 class="results-readline"> Find Your Favourite Mobile Phone By Brand </h1>


        </div>
    </div>


    <div class="container">
    <style>
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        width: 90%;
        margin: 20px auto;
        padding: 20px;
        box-sizing: border-box;
    }

    .grid-item {
        background-color: #f0f0f0;
        padding: 20px;
        text-align: center;
    }

    /* For demonstration purposes */
    .grid-item:nth-child(odd) {
        background-color: #e0e0e0;
    }

    @media (max-width: 768px) {
        .grid-container {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }
    }

    @media (max-width: 480px) {
        .grid-container {
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        }
    }
</style>
</head>
<body>

<div class="grid-container">

    <?php foreach ($brands as $brand): ?>
        <div class="grid-item" style="cursor:pointer" onclick="window.location.href='<?= BASE_URL?>/mobiles?brand=<?= strtolower($brand['name']) ?>' ">
            <img src="<?= BASE_URL?>/assets/images/brands/<?= $brand['logo'] ?>" alt="" style="width:90%; height:90%; object-fit:contain; margin:auto">
            <p style="text-align:center"><?= $brand['name'] ?></p>
        </div>
    <?php endforeach; ?>
</div>
    </div>

    <?php require_once './app/views/partials/footer.view.php' ?>

    <script src="./assets/js/app.js"></script>
    <!-- <script src="./assets/js/price-range.js"></script> -->
</body>

</html>