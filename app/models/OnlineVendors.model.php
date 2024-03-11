<?php 

Class OnlineVendors
{


	public static function get_all()
	{

		$DB = Database::getInstance();
		return $DB->read("select * from online_vendors");

	}

	public static function add_Vendor($name,$logo,$shop,$link)
    {
        $DB = Database::getInstance();



        $DBdata = array(
            'name' => $name,
            'logo' => $logo,
            'shop' => $shop,
            'link' => $link
        );

        $query = "insert into online_vendors (name,logo,shop,link) values (:name, :logo, :shop, :link)";

        $result = $DB->write($query, $DBdata);

        if($result)
        {
            return true;
        }else
        {
            return false;
        }
		
	}

    public static function edit_Vendor($name, $logo, $shop, $link, $id) {
        $DB = Database::getInstance();

        $DBdata = array(
            'name' => $name,
            'id' => $id,
            'logo' => $logo,
            'shop' => $shop,
            'link' => $link

        );

        
        $query = "update online_vendors set name = :name, logo = :logo, shop = :shop, link = :link where id = :id";

        $result = $DB->write($query, $DBdata);

        if($result)
        {
            return true;
        }else
        {
            return false;
        }
    }

    // public static function delete_brand($id){
    //     $DB = Database::getInstance();

    //     $DBdata = array(
    //         'id' => $id
    //     );

        
        
    //     $query = "delete from brands where id = :id";

    //     $result = $DB->write($query, $DBdata);

    //     if($result)
    //     {
    //         return true;
    //     }else
    //     {
    //         return false;
    //     }
    // }


	
}