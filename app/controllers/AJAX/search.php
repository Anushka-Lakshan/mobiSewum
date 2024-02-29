<?php



if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {


    $search = isset($_GET['searchText']) ? $_GET['searchText'] : "";

    include "app/core/Validator.php";

    if (!Validator::string($search, 1, 50)) {
        echo "Nothing found";
    }

    include "app/models/Category.model.php";
    $category = new Category();
    $categoryData = $category::searchCategoriesByName($search);

    include "app/models/Food.model.php";
    $food = new Food();
    $foodData = $food::searchFoodByName($search);
} else {
    // Handle non-AJAX requests if necessary
    // Redirect, display an error, or take appropriate action
    // You can also send a JSON response with an error message
    $response = array('success' => false, 'error' => 'script failed');
    echo json_encode($response);
}

?>

<div class="resultColumn">
    <p>Food items</p>

    <?php if(empty($foodData)): ?>
        <p>No food found</p>
    <?php endif; ?>


    <?php foreach ($foodData as $foodItem): ?>
        <div class="food-result">
            <img src="<?php echo $foodItem['img']; ?>" alt="">
            <div>
                <p class="title">
                    <a href="<?= BASE_URL ."/online-order";?>"><?php echo $foodItem['name']; ?></a>
                </p>
                <p class="price">Rs.<?php echo $foodItem['price']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<div class="resultColumn">
    <p>Food Categories</p>

    <?php if(empty($categoryData)): ?>
        <p>No category found</p>
    <?php endif; ?>

    <div class="cat-result">
        <?php foreach ($categoryData as $categoryItem): ?>
        <a href="#"><?php echo $categoryItem['name']; ?></a>
        <?php endforeach; ?>

    </div>
</div>