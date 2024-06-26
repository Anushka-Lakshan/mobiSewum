<?php

class Results
{

    public static function getResults($mobile, $brand, $min, $max, $sort, $only_inStock)
    {

        $DB = Database::getInstance();

        

        $nor = false;

        if($brand == "all"){
            $brand = "";
        }

        // chech if search query has version

        $version_divider = ["pro", "plus", "mini", "ultra", "max"];

        foreach ($version_divider as $d) {
            if (strpos($mobile, $d) !== false) {
                $nor = true;
                break;
            }
        }

        $sql = "";

        // if not search query has version (search for base version eg: iphone 12) remove versions from search query

        if (!$nor) {
            foreach ($version_divider as $d) {
                $sql = $sql . " AND online_mobiles.name NOT LIKE '%{$d}%'";
            }
        }
        
        if ($only_inStock) {
            $sql = $sql . " AND online_mobiles.in_stock = 1";
        }
        
        $sortOrder = ($sort == 'ASC' || $sort == 'DESC') ? $sort : 'ASC';
        
        // Query for scraped results
        
        $query = "SELECT online_mobiles.*, online_vendors.logo, online_vendors.name AS vendor, online_vendors.link AS vendor_link 
                  FROM online_mobiles 
                  INNER JOIN online_vendors ON online_mobiles.shop = online_vendors.shop 
                  WHERE online_mobiles.name LIKE :mobile 
                  AND online_mobiles.name LIKE :brand " . $sql . " 
                  AND price_int BETWEEN :min AND :max 
                  AND scraped = 1 
                  ORDER BY online_mobiles.price_int " . $sortOrder;

        // show($query);

        $DBdata = array(
            'mobile' => '%' . $mobile . '%',
            'min' => $min,
            'max' => $max,
            'brand' => '%' . $brand . '%',
        );

        $scraped = $DB->read($query, $DBdata);

        // query for unscraped results

        $query2 = "SELECT online_mobiles.*, shops.name AS vendor, shops.id AS shop_id, shops.logo AS shop_logo 
           FROM online_mobiles 
           INNER JOIN shops ON online_mobiles.shop = shops.id 
           WHERE online_mobiles.name LIKE :mobile 
           AND online_mobiles.name LIKE :brand " . $sql . " 
           AND price_int BETWEEN :min AND :max 
           AND scraped = 0 
           AND shops.suspended = 0 
           ORDER BY online_mobiles.price_int " . $sortOrder;

        //    $query2 = "SELECT * 
        //    FROM online_mobiles 
        //    WHERE online_mobiles.name LIKE :mobile";
           

        // show($query2);

        $DBdata = array(
            'mobile' => '%' . $mobile . '%',
            'min' => $min,
            'max' => $max,
            'brand' => '%' . $brand . '%',
        );

        $unscraped = $DB->read($query2, $DBdata);

        
        return array_merge($scraped, $unscraped);

        // return $unscraped;
        
    }

    public static function get_all()
    {

        $DB = Database::getInstance();
        return $DB->read("select * from online_mobiles");
    }
}
