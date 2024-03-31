<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Under Review</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 100px;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: auto;
            text-align: center;
            padding: 30px;
            background-color: #fff;
        }

        .btn {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h2 class="mb-4">Shop Under Review</h2>
            <p>Your shop is currently under review. Please wait until the admin of the site finishes the review and approves your shop.<br/> This will take around 12 hours.
            <br/>
            Thanks for your patience.
        </p>
            <a href="<?= BASE_URL ?>/contact-us" class="btn btn-primary">Contact us</a>
        </div>
    </div>
</body>

</html>
