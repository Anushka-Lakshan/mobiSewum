<?php

class Results
{

    public static function getResults($mobile, $brand, $min, $max, $sort)
    {

        $DB = Database::getInstance();

        $version_divider = ["pro", "plus", "mini", "ultra", "max"];

        $nor = false;

        if($brand == "all"){
            $brand = "";
        }

        foreach ($version_divider as $d) {
            if (strpos($mobile, $d) !== false) {
                $nor = true;
                break;
            }
        }

        $sql = "";

        if (!$nor) {

            foreach ($version_divider as $d) {
                $sql = $sql . "AND online_mobiles.name NOT LIKE '%{$d}%'";
            }
        }

        
        $sortOrder = ($sort == 'ASC' || $sort == 'DESC') ? $sort : 'ASC';

        $query = "SELECT online_mobiles.*, online_vendors.logo, online_vendors.name AS vendor, online_vendors.link AS vendor_link FROM online_mobiles INNER JOIN online_vendors ON online_mobiles.shop
        = online_vendors.shop WHERE online_mobiles.name LIKE :mobile AND online_mobiles.name LIKE :brand " . $sql . " AND price_int BETWEEN :min AND :max ORDER BY online_mobiles.price_int " . $sortOrder;

        // show($query);

        $DBdata = array(
            'mobile' => '%' . $mobile . '%',
            'min' => $min,
            'max' => $max,
            'brand' => '%' . $brand . '%',
        );

        return $DB->read($query, $DBdata);
    }

    public static function get_all()
    {

        $DB = Database::getInstance();
        return $DB->read("select * from online_mobiles");
    }
}
