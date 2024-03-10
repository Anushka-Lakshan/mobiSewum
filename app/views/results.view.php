<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>Mobisewum</title>
</head>

<body>
    <div class="result-header">
        <div class="container-nav">
            <header class="site-header">
                <div class="header__content--flow">
                    <section class="header-content--left">
                        <a href="<?= BASE_URL ?>/" class="brand-logo">
                            <img src="./assets/images/logo.png" alt="Mobisewum logo" />
                        </a>
                        <button class="nav-toggle">
                            <span class="toggle--icon"></span>
                        </button>
                    </section>
                    <section class="header-content--right">
                        <nav class="header-nav" role="navigation">
                            <ul class="nav__list" aria-expanded="false">
                                <li class="list-item">
                                    <a class="nav__link" href="<?= BASE_URL ?>/">Home</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav__link" href="#">Browse by Brands</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav__link" href="#">Mobile Stores</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav__link" href="#">Contact Us</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav__link" href="#">About Us</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav__link" href="#">List your store prices</a>
                                </li>
                            </ul>
                        </nav>
                    </section>
                </div>
            </header>
        </div>

        <div class="container">

            <h1 class="results-readline">Results for: <?= $mobile ?></h1>



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

                    $count = count($value['items']);

            ?>
                    <div class="result-card">
                        <div class="card-top">
                            <div class="shop">
                                <img src="<?= BASE_URL ?>/assets/images/company-logos/<?=$value['logo'] ?>" alt="geniusMobile">
                                <span> <a href="<?= $value['vendor_link'] ?>" target="_blank"><?= $brand ?> </a></span>
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
                                            <img src='<?= $mobile['img'] ?>' alt='<?= $mobile['name'] ?>' onerror="this.src='./assets/images/error-phone.png'">
                                        </td>
                                        <td>
                                            <a href='<?= $mobile['link'] ?>' target='_blank'> <?= $mobile['name'] ?> </a>

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

                ?>

                    <div class="result-card single">
                        <div class="card-top">
                            <div class="shop">
                                <img src="./assets/images/company-logos/geniusMobile.png" alt="geniusMobile">
                                <span><?= $mobile['shop'] ?></span>
                            </div>

                        </div>

                        <div class="card-bottom">
                            <table class="item-table">
                                <tr>
                                    <td>
                                        <img src="<?= $mobile['img'] ?>" alt="<?= $mobile['name'] ?>" onerror="this.src='./assets/images/error-phone.png'">
                                    </td>
                                    <td>
                                        <a href="<?= $mobile['link'] ?>" target="_blank"><?= $mobile['name'] ?></a>
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



    <script src="./assets/js/app.js"></script>
    <!-- <script src="./assets/js/price-range.js"></script> -->
</body>

</html>