<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">

    <div class="container">
        <?php 
            
               if(!empty($errors)){
                    echo "<div class='alert alert-danger'>";

                foreach($errors as $error){
                    echo "<p class='text-center'>$error</p>";
                }

                echo "</div>";
               }
            
        
        ?>
        <div class="d-flex justify-content-center align-items-center mt-5">


            <div class="card-signup">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item text-center">
                        <a class="nav-link active btl" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item text-center">
                        <a class="nav-link btr" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Signup</a>
                    </li>

                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        <div class="form px-4 pt-2">
                            <form action="" method="post">

                                <h2 class="text-center pb-3">Login to your account</h2>

                                <input type="email" class="form-control" name="l-email" placeholder="Enter your email">

                                <input type="password" class="form-control" placeholder="Password" name="l-password">

                                <button class="btn btn-dark btn-block" type="submit" value="login" name="login">Login</button>
                            </form>
                        </div>



                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">


                        <div class="form px-4">

                            <form action="" method="post">

                                <h2 class="text-center pb-3">Sign up for List your store</h2>

                                <input type="text" class="form-control" placeholder="Username" name="s-username" required>

                                <input type="email" class="form-control" placeholder="Email" name="s-email" required>

                                <input type="password" class="form-control" placeholder="Password" name="s-password" required>

                                <input type="password" class="form-control" placeholder="Confirm Password" name="s-cpassword" required>

                                <button class="btn btn-dark btn-block" type="submit" name="signup">Signup</button>

                            </form>

                        </div>



                    </div>

                </div>




            </div>


        </div>
    </div>

    <style>
        .card-signup {

            width: 400px;
            border: none;
            /* background-color: #f00; */
            padding: 10px;

        }

        .tab-content {
            background-color: white;
        }

        a {
            text-decoration: none;
        }


        .btr {

            border-top-right-radius: 5px !important;
        }


        .btl {

            border-top-left-radius: 5px !important;
        }

        .btn-dark {
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }


        .btn-dark:hover {
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }


        .nav-pills {

            display: table !important;
            width: 100%;
        }

        .nav-pills .nav-link {
            border-radius: 0px;
            border-bottom: 1px solid #0d6efd40;

        }

        .nav-item {
            display: table-cell;
            background: #0d6efd2e;
        }


        .form {

            padding: 10px;
            height: 300px;
        }

        .form input {

            margin-bottom: 12px;
            border-radius: 3px;
        }


        .form input:focus {

            box-shadow: none;
        }


        .form button {

            margin-top: 20px;
        }
    </style>

<?php require_once './app/views/partials/footer.view.php' ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/app.js"></script>
</body>

</html>