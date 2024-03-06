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

    public static function edit_category($id, $name){
        $DB = Database::getInstance();

        $DBdata = array(
            'name' => $name,
            'id' => $id
        );

        
        $query = "update categories set name = :name where id = :id";

        $result = $DB->write($query, $DBdata);

        if($result)
        {
            return true;
        }else
        {
            return false;
        }
    }

    public static function delete_category($id){
        $DB = Database::getInstance();

        $DBdata = array(
            'id' => $id
        );

        
        // $query = "update categories set name = :name where id = :id";
        $query = "delete from categories where id = :id";

        $result = $DB->write($query, $DBdata);

        if($result)
        {
            return true;
        }else
        {
            return false;
        }
    }

    public static function searchCategoriesByName($searchText) {
        $DB = Database::getInstance();
    
        
            // Use prepared statements to prevent SQL injection
        $searchText = "%$searchText%";
        $query = "SELECT * FROM categories WHERE name LIKE :searchText";
        $data = array('searchText' => $searchText);

        $results = $DB->read($query, $data);

        return $results;
        
    }
    

	
}