<?php 

Class VendorProducts
{


	public static function get_all()
	{

		$DB = Database::getInstance();
		return $DB->read("select * from online_mobiles where scraped = 0 order by id asc");

	}

    

	
}