<?php

class VendorProducts
{


	public static function get_all()
	{

		$DB = Database::getInstance();
		return $DB->read("select * from online_mobiles where scraped = 0 order by id asc");
	}

	public static function get_by_id($id)
	{

		$DB = Database::getInstance();
		return $DB->read("select * from online_mobiles where id = $id");
	}

	public static function get_by_vendor($id){

		$DB = Database::getInstance();
		return $DB->read("select * from online_mobiles where vendor_id = $id");
	}

	public static function add_mobile($name,$price,$in_stock,$image)
	{
		$DB = Database::getInstance();

		include_once "app/core/Validator.php";

		$DBdata = array(
			'name' => Validator::sanitizeInput($name),
			'price' => 'Rs.' . number_format($price, 2, '.', ','),
			'price_int' => $price,
			'in_stock' => $in_stock == true ? 1 : 0,
			'img' => $image,
			'scraped' => 0,
			'shop' => $_SESSION['Vendor_id'],
			'vendor_id' => $_SESSION['Vendor_id'],

		);

		$query = "insert into online_mobiles (name,price,price_int,in_stock,img,scraped,shop ,vendor_id) values (:name,:price,:price_int,:in_stock,:img,:scraped, :shop,:vendor_id)";

		$result = $DB->write($query, $DBdata);

		if ($result) {
			$query = "update vendors set have_shop = 1 where id = :id";
			$result = $DB->write($query, ['id' => $_SESSION['Vendor_id']]);

			return true;
		} else {
			return false;
		}
	}


	public static function edit_mobile($id, $name, $price, $in_stock, $image)
    {
        $DB = Database::getInstance();

        include_once "app/core/Validator.php";

        $DBdata = array(
            'id' => $id,
            'name' => Validator::sanitizeInput($name),
            'price' => 'Rs.' . number_format($price, 2, '.', ','),
            'price_int' => $price,
            'in_stock' => $in_stock == true ? 1 : 0,
            'img' => $image,
            'vendor_id' => $_SESSION['Vendor_id'],
        );

        $query = "UPDATE online_mobiles 
                  SET name = :name, price = :price, price_int = :price_int, 
                      in_stock = :in_stock, img = :img 
                  WHERE id = :id AND vendor_id = :vendor_id";

        $result = $DB->write($query, $DBdata);

        return $result ? true : false;
    }

    public static function delete_mobile($id)
    {
        $DB = Database::getInstance();

        $query = "DELETE FROM online_mobiles 
                  WHERE id = :id AND vendor_id = :vendor_id";

        $result = $DB->write($query, ['id' => $id, 'vendor_id' => $_SESSION['Vendor_id']]);

        return $result ? true : false;
    }

	
}
