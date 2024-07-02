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

            <h1 class="results-readline"> GET IN TOUCH WITH US </h1>


        </div>
    </div>


    <div class="container">

        <?php
            if (isset($_SESSION['Vendor_id'])) : ?>
                
            <div class="vendor-note"><p>You are now contact as a Vendor</p></div>

        <?php endif ?>

        <?php if ($errors && count($errors) > 0) {
            echo '<div class="errors">';
            foreach ($errors as $error) {
                echo    '<p>' . $error . '</p>';
            }
            echo '</div>';
        } ?>
            

        <div class="form-inner">
            <form action="" method="POST" class="form-decor">
                <h1><b>Contact US</b></h1>
                <input type="text" placeholder="Name" required name="name"/>
                <input type="tel" placeholder="Phone" maxlength="10" required name="phone"/>
                <input type="email" placeholder="Email" required name="email"/>
                <textarea placeholder="Message" rows="4" required name="message"></textarea>
                <button type="submit" href="/">SUBMIT</button>
            </form>
        </div>

    </div>

    <style>
        .vendor-note{
            padding: 20px;
            background: rgb(79, 175, 79);
            border-radius: 12px;
            color: white;
            width: fit-content;
            margin: 10px auto;
        }

        .errors{
            padding: 20px;
            background: #f00;
            border-radius: 12px;
            color: white;
            width: fit-content;
            margin: 10px auto;
        }

        .intro-2 {
            padding-left: 10px;
            flex: 10%
        }

        input,
        textarea {
            outline: none;
        }

        .form-inner h1 {
            margin-top: 0;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .form-decor {
            color: white;
            padding: 40px;
            border-radius: 15px;
            background: #303030;
            text-align: center;
        }

        .form-inner {
            padding: 40px;
            max-width: 600px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-inner input,
        .form-inner textarea {
            display: block;
            width: -webkit-fill-available;
            padding: 15px;
            margin-bottom: 15px;
            border: none;
            background: #eaeaea;
        }

        .form-inner textarea {
            resize: none;
        }

        .form-inner button {
            margin-top: 10px;
            width: 50%;
            padding: 15px;
            border: none;
            background: #4a6ee0;
            font-size: 16px;
            font-weight: 400;
            color: #fff;
        }

        .form-inner button:hover {
            background: #294cbc;
        }

        @media (min-width: 568px) {
            form {
                width: 90%;
            }
        }
    </style>

<?php require_once './app/views/partials/footer.view.php' ?>

    <script src="./assets/js/app.js"></script>
    <!-- <script src="./assets/js/price-range.js"></script> -->
</body>

</html>