<?php 

Class ScrapedProducts
{


	public static function get_all()
	{

		$DB = Database::getInstance();
		return $DB->read("select * from online_mobiles where scraped = 1 order by id asc");

	}

    public static function get_Records(){
        $DB = Database::getInstance();
		return $DB->read("select * from scrap_log order by id asc");
    }

	
}