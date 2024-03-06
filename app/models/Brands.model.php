<?php 

Class Brands
{


	public static function get_all()
	{

		$DB = Database::getInstance();
		return $DB->read("select * from brands order by id asc");

	}

	public static function add_brand($name,$logo)
    {
        $DB = Database::getInstance();



        $DBdata = array(
            'name' => $name,
            'logo' => $logo
        );

        $query = "insert into brands (name,logo) values (:name, :logo)";

        $result = $DB->write($query, $DBdata);

        if($result)
        {
            return true;
        }else
        {
            return false;
        }
		
	}

    public static function edit_brand($id, $name, $logo) {
        $DB = Database::getInstance();

        $DBdata = array(
            'name' => $name,
            'id' => $id,
            'logo' => $logo

        );

        
        $query = "update brands set name = :name, logo = :logo where id = :id";

        $result = $DB->write($query, $DBdata);

        if($result)
        {
            return true;
        }else
        {
            return false;
        }
    }

    public static function delete_brand($id){
        $DB = Database::getInstance();

        $DBdata = array(
            'id' => $id
        );

        
        
        $query = "delete from brands where id = :id";

        $result = $DB->write($query, $DBdata);

        if($result)
        {
            return true;
        }else
        {
            return false;
        }
    }


	
}