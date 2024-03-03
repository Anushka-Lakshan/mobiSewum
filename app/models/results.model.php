<?php

class Results
{

    public static function getResults($mobile, $brand, $min, $max, $sort)
    {

        $DB = Database::getInstance();

        $version_divider = ["pro", "plus", "mini", "ultra", "max"];

        $nor = false;

        foreach ($version_divider as $d) {
            if (strpos($mobile, $d) !== false) {
                $nor = true;
                break;
            }
        }

        $sql = "";

        if (!$nor) {

            foreach ($version_divider as $d) {
                $sql = $sql . "AND name NOT LIKE '%{$d}%'";
            }
        }

        
        $sortOrder = ($sort == 'ASC' || $sort == 'DESC') ? $sort : 'ASC';

        $query = "SELECT * FROM online_mobiles WHERE name LIKE :mobile " . $sql . " AND price_int BETWEEN :min AND :max ORDER BY price_int " . $sortOrder;

        // show($query);

        $DBdata = array(
            'mobile' => '%' . $mobile . '%',
            'min' => $min,
            'max' => $max
        );

        return $DB->read($query, $DBdata);
    }

    public static function get_all()
    {

        $DB = Database::getInstance();
        return $DB->read("select * from online_mobiles");
    }
}
