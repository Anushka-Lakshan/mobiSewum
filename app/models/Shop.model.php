<?php 

Class Shop
{


	public static function get_all()
	{

		$DB = Database::getInstance();
		return $DB->read("select * from shops order by id asc");

	}

	public static function add_shop($name,$address,$tel, $reg_no,$logo,$img)
    {
        $DB = Database::getInstance();

        include_once "app/core/Validator.php";

        $DBdata = array(
            'id' => $_SESSION['Vendor_id'],
            'name' => Validator::sanitizeInput($name),
            'address' => Validator::sanitizeInput($address),
            'tel' => Validator::sanitizeInput($tel),
            'reg_no' => Validator::sanitizeInput($reg_no),
            'logo' => Validator::sanitizeInput($logo),
            'img' => Validator::sanitizeInput($img),
            'create_date' => date('Y-m-d H:i:s')
            
        );

        $query = "insert into shops (id,name,address,tel,registration_no,logo,img,create_date) values (:id, :name, :address, :tel, :reg_no, :logo, :img, :create_date)";

        $result = $DB->write($query, $DBdata);

        if($result)
        {
            $query = "update vendors set have_shop = 1 where id = :id";
            $result = $DB->write($query, ['id' => $_SESSION['Vendor_id']]);

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