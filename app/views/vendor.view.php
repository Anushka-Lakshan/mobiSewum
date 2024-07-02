<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>Mobisewum</title>
  </head>

  <body>
    <div class="">
      <div class="container-nav">
        <header class="site-header">
          <div class="header__content--flow">
            <?php require 'partials/top_nav.view.php'; ?>
          </div>
        </header>
      </div>
    </div>

    <header class="header">
      <div class="cover-photo">
        <!-- Placeholder for cover photo -->
        <img
          src="<?= BASE_URL ?>/assets/images/business/logos/<?= $shop['logo'] ?>"
          alt="Cover Photo"
        />
      </div>
      <div class="profile">
        <!-- Placeholder for profile picture -->
        <img
          src="<?= BASE_URL ?>/assets/images/business/shops/<?= $shop['img'] ?>"
          alt="Profile Picture"
        />
      </div>
      <h2><?= $shop['name'] ?></h2>
    </header>

    <div class="container">
      <div class="vendor-row">
        <div class="column">
          Email Address: 
          <?= $shop['address'] ?> <br />
        </div>
        <div class="column">
          Phone: <?= $shop['tel'] ?> <br />
          
        </div>
      </div>

      <div class="product-container">

        <!-- Product Cards -->
         <?php

         foreach ($Products as $product) {
             
            ?>

            <div class="product-card">
              <img
                src="<?= BASE_URL ?>/assets/images/mobile-images/<?= $product['img'] ?>"
                alt="Product 1"
              />
              <h2><?= $product['name'] ?></h2>
              <p><?= $product['price'] ?></p>
            </div>
            <?php
         }
         
         ?>

        
      </div>
    </div>

    <style>
      .container-nav {
        background-color: #ffffff81;
        /* padding: 10px; */
        border-radius: 10px;
      }
      .vendor-row {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
      }

      /* Column styles */
      .column {
        flex: 1;
        min-width: 50%;
        padding: 10px;
        box-sizing: border-box;
        background-color: #f4f4f4;
        text-align: center;
        border: 1px solid #ccc; /* Optional for visual separation */
      }

      /* Responsive adjustments */
      @media (max-width: 768px) {
        .column {
          min-width: 100%; /* Stack columns vertically on smaller screens */
        }
      }
      /* Header Styles */
      .header {
        position: relative;
        margin-top: -100px;
        z-index: -1;
        color: #fff;
        text-align: center;
        padding: 0px 0;
        margin-bottom: 80px;
      }

      .cover-photo img {
        width: 100%;

        display: block;
        height: 400px;
        object-fit: cover;
      }

      .profile img {
        width: 200px;
        /* Adjust the profile picture size */
        height: 200px;
        border-radius: 50%;
        /* Rounded profile picture */
        border: 4px solid #fff;
        /* White border around profile picture */
        position: absolute;
        left: 20%;
        transform: translateX(-50%);
        bottom: -75px;
        /* Adjust this value as needed for spacing */
        background-color: #fff;
        /* White background */
        z-index: 4;
      }

      .header h2 {
        position: absolute;
        left: calc(20% + 50px);
        /*            transform: translateX(-50%);*/
        bottom: -50px;
        z-index: 2;
        background: linear-gradient(to right, #1b376b, #4066ad);
        color: aliceblue;
        font-size: 3rem;
        padding: 20px;
        width: calc(80% - 50px);
        text-align: left;
        padding-left: 100px;
      }

      .product-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        padding: 20px;
        background-color: #f9f9f9;
        margin-bottom: 50px;
      }

      /* Product card styles */
      .product-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }

      .product-card img {
        max-width: 100%;
        border-radius: 5px;
      }

      .product-card h2 {
        font-size: 1.2em;
        margin: 10px 0;
      }

      .product-card p {
        font-size: 1em;
        color: #333;
      }

      /* Responsive adjustments */
      @media (max-width: 1024px) {
        .product-container {
          grid-template-columns: repeat(3, 1fr);
        }
      }

      @media (max-width: 768px) {
        .product-container {
          grid-template-columns: repeat(2, 1fr);
        }
      }

      @media (max-width: 480px) {
        .product-container {
          grid-template-columns: 1fr;
        }
      }
    </style>

<?php require_once './app/views/partials/footer.view.php' ?>

    <script src="./assets/js/app.js"></script>
    <script src="./assets/js/price-range.js"></script>
  </body>
</html>
