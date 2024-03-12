<?php

include "app/models/Brands.model.php";


$brands = Brands::get_all();

include "app/views/browseByBrand.view.php";
