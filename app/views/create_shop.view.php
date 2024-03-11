<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/register.css" />
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
    <div class="cotainer">

                <?php if(!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                            <div><?php echo $error ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif ?>           

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Please get approvel to your account before posting a product</div>
                            <div class="card-body">
                                <form name="my-form" action="" method="POST" enctype="multipart/form-data">

                                    <div class="form-group row">
                                        <label for="business_name" class="col-md-4 col-form-label text-md-right">Business Name</label>
                                        <div class="col-md-6">
                                            <input type="text" id="business_name" class="form-control" name="business_name" required>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="business_email_address" class="col-md-4 col-form-label text-md-right">Email Address (Business)</label>
                                        <div class="col-md-6">
                                            <input type="email" id="business_email_address" class="form-control" name="business_email" required>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label for="business_registration_number" class="col-md-4 col-form-label text-md-right">Business Registration Number</label>
                                        <div class="col-md-6">
                                            <input type="text" id="business_registration_number" class="form-control" name="business_registration" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="telephone_number" class="col-md-4 col-form-label text-md-right">Business Telephone Number</label>
                                        <div class="col-md-6">
                                            <input type="tel" id="telephone_number" class="form-control" name="business_telephone" required>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="formFile" class=" col-md-4 col-form-label text-md-right">Please Upload Your Business Logo (jpg, png required)</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="file" id="formFile" name="business_logo" accept="image/jpeg,image/jpg,image/png" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="formFile" class=" col-md-4 col-form-label text-md-right">Please Upload Your Shop image (jpg required)</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="file" id="formFile" name="shop_image" accept="image/jpeg,image/jpg" required>
                                        </div>
                                    </div>



                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>


</body>

</html>
