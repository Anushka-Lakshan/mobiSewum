<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/style.css" />
  <title>Mobisewum</title>
</head>

<body>
  <div class="container-nav">
    <header class="site-header">
      <div class="header__content--flow">
        
        <?php require 'partials/top_nav.view.php'; ?>
      </div>
    </header>
  </div>

  <div class="container">
  <section class="section_all bg-light" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section_title_all text-center">
                            <h3 class="font-weight-bold">Welcome To Mobisewum</h3>
                            <p class="section_subtitle mx-auto text-muted">Mobile phone price research platform!</p>
                            <div class="">
                                <i class=""></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row vertical_content_manage mt-5">
                    <div class="col-lg-6">
                        <div class="about_header_main mt-3">
                            
                            <p class="text-muted mt-3">
                            Welcome to Mobi Sewum, Sri Lanka's premier mobile marketplace platform dedicated to simplifying the process of finding the best mobile phone deals across the island.

At Mobi Sewum, we understand the challenges individuals face when searching for the perfect mobile device amidst a sea of options and varying prices. Our mission is to alleviate this burden by providing a centralized platform where users can effortlessly compare prices, explore options, and make informed purchasing decisions.

Driven by a passion for innovation and a commitment to customer satisfaction, our platform leverages cutting-edge web scraping technology to aggregate real-time pricing information from a diverse range of vendors, both large-scale retailers and small to medium-sized businesses. We believe in inclusivity and empowerment, which is why we provide businesses without an online presence the opportunity to list their mobile phone prices on our platform, thereby fostering local entrepreneurship and expanding accessibility for users.
                            </p>

                            </div>
                    </div>

                    <div class="col-lg-6">
                        <img class="img-fluid" src="<?= BASE_URL?>/assets/images/about.jpg" alt="">
                    </div>
                    
                </div>

                
            </div>
        </section>
  </div>

  <script src="./assets/js/app.js"></script>
  <script src="./assets/js/price-range.js"></script>
</body>

</html>