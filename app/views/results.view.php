<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>Mobisewum | Results: <?= $mobile === '' ?  strtoupper($_GET['brand']) : $mobile ?></title>

    <style>
        .tooltip {
            position: relative;
            /* display: inline-block;
            /* border-bottom: 1px dotted black; */
            font-family: sans-serif;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            /*  width: 120px;*/
            background-color: #232323e6;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 5;
            bottom: 125%;
            left: 0%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltiptext .tipRow {
            display: flex;
            padding: 5px;
            gap: 5px;
            justify-content: center;
        }

        .tipRow>img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-right: 10px;
            object-position: center center;
        }

        .tipDetails {
            min-width: 150px;

        }

        .tipDetails * {
            text-align: left;
            margin: 2px;
            padding: 2px;
        }

        .tipDetails p {
            font-size: 1.1rem;
            text-align: center;
            margin-bottom: 8px;
            border-bottom: solid 1px #8a8a8a;

        }

        .tipDetails p a {
            color: #fff;
            text-decoration: none;
        }

        .tipDetails span {
            background-color: cadetblue;
            padding: 3px 5px;
            border-radius: 4px;
            margin-right: 3px;
            font-size: 0.8rem;
        }

        .tipDetails span:nth-of-type(1) {
            background-color: green;
        }

        .tipDetails span:nth-of-type(2) {
            background-color: coral;
        }

        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
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

            <h1 class="results-readline">Results for: <?= $mobile === '' ?  strtoupper($_GET['brand']) : $mobile ?></h1>



            <p class="results-count"><?= $resultCount === 0 ? 'No results found' : $resultCount . ' results found' ?></p>
        </div>
    </div>


    <div class="container">

        <div class="search-area">
            <form action="<?= BASE_URL ?>/mobiles" method="get">
                <input type="text" name="phone" id="search" placeholder="Enter Mobile Phone name ..." value="<?= $mobile ?>" />
                <button type="submit">Search</button>
            </form>
        </div>

    </div>

    </div>

    <main class="container search-content">

        <div class="filter-container">

            <button id="toggleButton" class="">Filter</button>



            <form action="<?= BASE_URL ?>/mobiles" method="get" class="filter-card">
                <p>Filter options</p>

                <div class="filter-brand">
                    <label for="result-brand">Search by Brand:</label>

                    <select name="brand" id="result-brand">
                        <option value="all">All</option>

                        <?php foreach ($brands as $brand) : ?>
                            <option value="<?= strtolower($brand['name']) ?>" <?= isset($_GET['brand']) && $_GET['brand'] === strtolower($brand['name']) ? 'selected' : '' ?>><?= $brand['name'] ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="result-group">Don't Group by shops</label>
                    <label class="switch">
                        <input name="not-group" id="result-group" type="checkbox" <?= isset($_GET['not-group']) && $_GET['not-group'] ? 'checked' : '' ?> />
                        <div></div>
                    </label>
                </div>

                <div class="filter-group">
                    <label for="stock-group">Only In stock</label>
                    <label class="switch">
                        <input name="in-stock" id="stock-group" type="checkbox" <?= isset($_GET['in-stock']) && $_GET['in-stock'] ? 'checked' : '' ?> />
                        <div></div>
                    </label>
                </div>

                <div class="result-filter">
                    <label for="result-sort">Sort by: </label>
                    <select name="sort" id="result-sort">
                        <option value="">Default</option>
                        <option value="toHigh" <?= isset($_GET['sort']) && ($_GET['sort'] === 'toHigh') ? 'selected' : '' ?>>Low to High</option>
                        <option value="toLow" <?= isset($_GET['sort']) && ($_GET['sort'] === 'toLow') ? 'selected' : '' ?>>High to low</option>
                    </select>
                </div>

                <div class="filter-price">
                    <label for="min-price">
                        Price Range:
                    </label>

                    <table>
                        <tr>
                            <td>
                                <label for="min-price">Min :</label>
                            </td>
                            <td>
                                <input type="number" name="min" id="min-price" value="<?= $_GET['min'] ?? '' ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="max-price">Max :</label>
                            </td>
                            <td>
                                <input type="number" name="max" id="max-price" value="<?= $_GET['max'] ?? '' ?>" />

                            </td>
                        </tr>

                        <input type="hidden" name="phone" value="<?= $_GET['phone'] ?? '' ?>">


                    </table>


                </div>

                <button type="submit">Filter</button>
            </form>

            <script>
                const toggleButton = document.getElementById("toggleButton");
                const form = document.querySelector("form.filter-card");

                toggleButton.addEventListener("click", () => {
                    if (window.innerWidth < 950) {
                        form.classList.toggle("hidden");
                    }
                });
            </script>

        </div>


        <!-- search results start -->
        <div class="result-container">

            <?php

            if ($resultCount === 0) {
                echo '<p style="text-align:center"> Sorry! , No results found</p>';
            }

            ?>

            <?php

            if ($group) {


                foreach ($groupedResults as $key => $value) {

                    $brand = $value['vendor'];

                    $scraped = $value['scraped'] === 1;

                    $count = count($value['items']);

            ?>
                    <div class="result-card">
                        <div class="card-top">
                            <div class="shop tooltip">

                                <?php if ($scraped) : ?>
                                    <img src="<?= BASE_URL ?>/assets/images/company-logos/<?= $value['logo'] ?>" alt="<?= $brand ?>">
                                    <span> <a href="<?= $value['vendor_link'] ?>" target="_blank"><?= $brand ?> </a></span>

                                    <div class="tooltiptext">
                                        <div class="tipRow">
                                            <img src="<?= BASE_URL ?>/assets/images/company-logos/<?= $value['logo'] ?>" alt="<?= $brand ?>">
                                            <div class="tipDetails">
                                                <p><a href="<?= $value['vendor_link'] ?>" target="_blank"><?= $brand ?> </a></p>
                                                <span>Buy Online</span>
                                                <span>Shop</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <img src="<?= BASE_URL ?>/assets/images/business/logos/<?= $value['shop_logo'] ?>" alt="<?= $brand ?>">
                                    <span> <a href="<?= BASE_URL ?>/vendor?vendor=<?= $value['vendor_id'] ?>" target="_blank"><?= $brand ?> </a></span>

                                    <div class="tooltiptext">
                                        <div class="tipRow">
                                            <img src="<?= BASE_URL ?>/assets/images/business/logos/<?= $value['shop_logo'] ?>" alt="<?= $brand ?>">
                                            <div class="tipDetails">
                                                <p><a href="<?= BASE_URL ?>/vendor?vendor=<?= $value['vendor_id'] ?>" target="_blank"><?= $brand ?> </a></p>
                                                <!-- <span>Buy Online</span> -->
                                                <span>Visit Shop</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>


                            </div>

                            <div class="item-count">
                                <?= $count ?> mobiles
                            </div>
                        </div>

                        <div class="card-bottom">
                            <table class="item-table">

                                <?php

                                foreach ($value['items'] as $mobile) {

                                ?>

                                    <tr>
                                        <td>
                                            <?php if ($scraped) : ?>
                                                <img src='<?= $mobile['img'] ?>' alt='<?= $mobile['name'] ?>' onerror="this.src='./assets/images/error-phone.png'">
                                            <?php else : ?>
                                                <img src='<?= BASE_URL ?>/assets/images/mobile-images/<?= $mobile['img'] ?>' alt='<?= $mobile['name'] ?>' onerror="this.src='./assets/images/error-phone.png'">
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                        <?php if ($scraped) : ?>
                                            <a href="<?= $mobile['link'] ?>" target="_blank"><?= $mobile['name'] ?></a>
                                        <?php else : ?>
                                            <a href="<?= BASE_URL ?>/vendor?vendor=<?= $mobile['vendor_id'] ?>" target="_blank"><?= $mobile['name'] ?></a>
                                        <?php endif; ?>

                                            <?= $mobile['in_stock'] == 0 ? "<span class='stock-badge'>Out of stock</span> " : " " ?>



                                        </td>
                                        <td>
                                            <?= $mobile['price'] ?>
                                        </td>
                                    </tr>

                                <?php
                                }

                                ?>

                            </table>
                        </div>
                    </div>


                <?php
                }
            } else {
                foreach ($result as $mobile) {

                    $scraped = $mobile['scraped'] === 1;
                    $brand = $mobile['vendor'];

                ?>

                    <div class="result-card single">
                        <div class="card-top">
                            <div class="shop tooltip">
                                <?php if ($scraped) : ?>
                                    <img src="<?= BASE_URL ?>/assets/images/company-logos/<?= $mobile['logo'] ?>" alt="<?= $brand ?>">
                                    <span> <a href="<?= $mobile['vendor_link'] ?>" target="_blank"><?= $brand ?> </a></span>

                                    <div class="tooltiptext">
                                        <div class="tipRow">
                                            <img src="<?= BASE_URL ?>/assets/images/company-logos/<?= $mobile['logo'] ?>" alt="<?= $brand ?>">
                                            <div class="tipDetails">
                                                <p><a href="<?= $value['vendor_link'] ?>" target="_blank"><?= $brand ?> </a></p>
                                                <span>Buy Online</span>
                                                <span>Shop</span>
                                            </div>
                                        </div>
                                    </div>

                                <?php else : ?>

                                    <img src="<?= BASE_URL ?>/assets/images/business/logos/<?= $mobile['shop_logo'] ?>" alt="<?= $brand ?>">
                                    <span> <a href="<?= BASE_URL ?>/vendor?vendor=<?= $mobile['vendor_id'] ?>" target="_blank"><?= $brand ?> </a></span>

                                    <div class="tooltiptext">
                                        <div class="tipRow">
                                            <img src="<?= BASE_URL ?>/assets/images/business/logos/<?= $mobile['shop_logo'] ?>" alt="<?= $brand ?>">
                                            <div class="tipDetails">
                                                <p><a href="<?= BASE_URL ?>/vendor?vendor=<?= $mobile['vendor_id'] ?>" target="_blank"><?= $brand ?> </a></p>
                                                <!-- <span>Buy Online</span> -->
                                                <span>Visit Shop</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="card-bottom">
                            <table class="item-table">
                                <tr>
                                    <td>
                                        <?php if ($scraped) : ?>
                                            <img src='<?= $mobile['img'] ?>' alt='<?= $mobile['name'] ?>' onerror="this.src='./assets/images/error-phone.png'">
                                        <?php else : ?>
                                            <img src='<?= BASE_URL ?>/assets/images/mobile-images/<?= $mobile['img'] ?>' alt='<?= $mobile['name'] ?>' onerror="this.src='./assets/images/error-phone.png'">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($scraped) : ?>
                                            <a href="<?= $mobile['link'] ?>" target="_blank"><?= $mobile['name'] ?></a>
                                        <?php else : ?>
                                            <a href="<?= BASE_URL ?>/vendor?vendor=<?= $value['vendor_id'] ?>" target="_blank"><?= $mobile['name'] ?></a>
                                        <?php endif; ?>
                                        <!-- <a href="<?= $mobile['link'] ?>" target="_blank"><?= $mobile['name'] ?></a> -->
                                        <?= $mobile['in_stock'] == 0 ? "<span class='stock-badge'>Out of stock</span> " : " " ?>
                                    </td>
                                    <td>
                                        <?= $mobile['price'] ?>
                                    </td>
                                </tr>


                            </table>
                        </div>
                    </div>


            <?php
                }
            }
            ?>




        </div>

    </main>

    <?php require_once './app/views/partials/footer.view.php' ?>


    <script src="./assets/js/app.js"></script>
    <!-- <script src="./assets/js/price-range.js"></script> -->


</body>

</html>