<main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="dashboard-header">
        <h1 class="h2">Edit Mobile</h1>
        <p><a href="<?= BASE_URL ?>/admin-dashboard?page=vendor-products"> Go back </a></p>
    </div>

    <?php

    include "app/models/Brands.model.php";
    include "app/models/VendorProducts.model.php";

    $Brands = Brands::get_all();

    $id = null;
    $mobile = null;

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $mobile = VendorProducts::get_by_id($id);
    }else{
        header("Location: " . BASE_URL . "/admin-dashboard?page=vendor-products");
    }

    $mobile = $mobile[0];
    // show($mobile);


    ?>

    <?php
        $errors = array();

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if(isset($_POST['edit_mobile'])){
                
                if(!isset($_POST['brand']) && !isset($_POST['model']) && !isset($_POST['price']) && !isset($_POST['in_stock'])){
                    array_push($errors, "All fields are required");
                }

                $name = $_POST['brand'] . " " . $_POST['model'];
                $price = $_POST['price'];
                $in_stock = $_POST['in_stock'] == "on" ? true : false;

                if($_FILES['image']['error'] == UPLOAD_ERR_OK && $_FILES['image']['size'] > 0){

                    $fileExtension = pathinfo($_FILES["image"]['name'], PATHINFO_EXTENSION);
                    $imageInfo = @getimagesize($_FILES["image"]['tmp_name']);

                    if($fileExtension != "jpg" && $fileExtension != "jpeg" && $fileExtension != "png"){
                        array_push($errors, "Only jpg, jpeg and png files are allowed");
                    }

                    if(empty($errors)){
                        $image = "mobile_" . uniqid() . "." . $fileExtension;
                        $uploadDirectory = './assets/images/mobile-images/' . $image;

                        if(!move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory)){
                            array_push($errors, "Image could not be uploaded");
                        }
                        
                    }

                }
                else{
                    array_push($errors, "Image is required and should be smaller than 1MB");
                }

                if(empty($errors)){
                    
                    // include "app/models/VendorProducts.model.php";

                    $result = VendorProducts::edit_mobile($id, $name, $price, $in_stock, $image);

                    if($result){
                        
                        sweetAlert("Mobile Edited Successfully", "success");
                        header("Location: " . BASE_URL . "/vendor-dashboard?page=mobiles");

                    }else{
                        array_push($errors, "Something went wrong. Please try again");
                    }

                }

            }

        }
    ?>

    <div class="row ml-5">
        <?php

        if(!empty($errors)){
            echo "<div class='alert alert-danger' role='alert'>";
            foreach($errors as $error){
                echo "<p class='text-danger'>" . $error . "</p>";
            }

            echo "</div>";
        }

        $selected = null;

        foreach($Brands as $brand){
            
            if (stripos($mobile['name'], $brand['name']) !== false) {
                $selected = $brand['name'];
            }
        }

        

        ?>

        <form method="POST" action="" enctype="multipart/form-data">

            <div class="form-group">
                <label>Select Brand</label>
                <select name="brand" class="form-control" required onchange="selectBrand(this.value)">
                    <option value="" disabled selected>Select Brand</option>
                    <?php foreach ($Brands as $brand) : ?>
                        <option value="<?= $brand['name'] ?>" <?= (isset($_POST['brand']) && $_POST['brand'] == $brand['name']) || $selected == $brand['name']  ? 'selected' : '' ?> ><?= $brand['name'] ?></option>

                    <?php endforeach; ?>
                </select>
            </div>

            <label for="basic-url">Model Name</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text brand-select-text" id="basic-addon3"><?= isset($_POST['brand'])  ? $_POST['brand'] : 'Select Brand' ?></span>
                </div>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Model Name" required name="model" value="<?= $mobile['name'] ?>">
            </div>

            <label for="price">Price</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Rs. </span>
                </div>
                <input type="number" class="form-control" id="price" aria-describedby="basic-addon3" placeholder="enter price" required name="price" value="<?= $mobile['price_int'] ?>">
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" <?= $mobile['in_stock'] == 1 ? 'checked' : '' ?> name="in_stock">
                    <label class="form-check-label" for="gridCheck">
                        In Stock
                    </label>
                </div>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload Mobile Image</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" required name="image" accept="image/jpg, image/jpeg, image/png" onchange="loadFile(event)">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <button type="submit" name="edit_mobile" class="btn btn-primary">Edit Mobile</button>
        </form>


        <script>
            function selectBrand(brand) {
                document.querySelector(".brand-select-text").innerHTML = brand;
            }

            function loadFile(event) {
                document.querySelector(".custom-file-input").files = event.target.files;

                document.querySelector(".custom-file-label").innerHTML = event.target.files[0].name;
            }
        </script>
    </div>
</main>