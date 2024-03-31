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

    public static function edit($id, $name, $address, $tel, $reg_no, $logo, $img)
    {
        $DB = Database::getInstance();

        include_once "app/core/Validator.php";

        $DBdata = array(
            'id' => $id,
            'name' => Validator::sanitizeInput($name),
            'address' => Validator::sanitizeInput($address),
            'tel' => Validator::sanitizeInput($tel),
            'reg_no' => Validator::sanitizeInput($reg_no),
            'logo' => Validator::sanitizeInput($logo),
            'img' => Validator::sanitizeInput($img)
        );

        $query = "UPDATE shops SET name = :name, address = :address, tel = :tel, registration_no = :reg_no, logo = :logo, img = :img WHERE id = :id";

        $result = $DB->write($query, $DBdata);

        return $result ? true : false;
    }

    public static function delete($id)
    {
        $DB = Database::getInstance();

        $query = "DELETE FROM shops WHERE id = :id";
        $result = $DB->write($query, ['id' => $id]);

        return $result ? true : false;
    }

    public static function get_shop_by_id($id)
    {
        $DB = Database::getInstance();
        $query = "SELECT * FROM shops WHERE id = :id";
        return $DB->read($query, ['id' => $id]);
    }

    public static function approve($id)
    {
        $DB = Database::getInstance();
        $query = "UPDATE shops SET approved = 1 WHERE id = :id";
        return $DB->write($query, ['id' => $id]);
    }

    public static function suspend($id)
    {
        $DB = Database::getInstance();
        $query = "UPDATE shops SET suspended = 1 WHERE id = :id";
        return $DB->write($query, ['id' => $id]);
    }

    public static function unsuspend($id)
    {
        $DB = Database::getInstance();
        $query = "UPDATE shops SET suspended = 0 WHERE id = :id";
        return $DB->write($query, ['id' => $id]);
    }
	
}