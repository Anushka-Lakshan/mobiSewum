<?php


include "app/models/Food.model.php";

$food = new Food();

$tableData = $food::get_all();


include "app/models/Category.model.php";

$category = new Category();

$categories = $category::get_all();



include("app/views/online-order.view.php");