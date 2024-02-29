<?php 

Class Branch
{


	public static function get_all()
	{

		$DB = Database::getInstance();
		return $DB->read("select * from branches order by Branch_Id desc");

	}

    public static function get_branch_by_id($id)
	{

		$DB = Database::getInstance();

        return $DB->read("select * from branches where Branch_Id = :id limit 1", array('id' => $id));

	}


	public static function branch_exists($branchId){

		$branches = self::get_all();
		
		if (isset($_POST['res-branch'])) {
            $selectedBranchId = $_POST['res-branch'];
            
            $branchExists = false;
            foreach ($branches as $branch) {
                if ($branch['Branch_Id'] == $selectedBranchId) {
                    $branchExists = true;
                    break;
                }
            }

            return $branchExists;
        }
	}


    public static function add_branch($name, $address, $seatCapacity, $telNo, $latitude, $longitude)
    {
        $DB = Database::getInstance();

        $errors = array();


        if (empty($name) || strlen($name) > 50) {
            $errors[] = 'Invalid branch name.';
        }

        if(!is_numeric($latitude) && !is_numeric($longitude)) {
            array_push($errors, 'Invalid coordinates.');
        }

        if (count($errors) > 0) {
            return $errors;
        }

        $data = array(
            'Name' => $name,
            'Address' => $address,
            'SeatCapacity' => $seatCapacity,
            'Tel_no' => $telNo,
            'Latitude' => $latitude,
            'Longitude' => $longitude
        );

        $result = $DB->write("INSERT INTO branches (Name, Address, SeatCapacity, Tel_no, Latitude, Longitude) VALUES (:Name, :Address, :SeatCapacity, :Tel_no, :Latitude, :Longitude)", $data);

        return $result ? array('success' => true) : array('Failed to add the branch.');
    }

    public static function update_branch($branchId, $name, $address, $seatCapacity, $telNo, $latitude, $longitude)
    {
        $DB = Database::getInstance();

        $errors = array();


        if (empty($name) || strlen($name) > 50) {
            $errors[] = 'Invalid branch name.';
        }

        if(!is_numeric($latitude) && !is_numeric($longitude)) {
            array_push($errors, 'Invalid coordinates.');
        }

        if (count($errors) > 0) {
            return $errors;
        }

        $data = array(
            'Branch_Id' => $branchId,
            'Name' => $name,
            'Address' => $address,
            'SeatCapacity' => $seatCapacity,
            'Tel_no' => $telNo,
            'Latitude' => $latitude,
            'Longitude' => $longitude
        );

        $result = $DB->write("UPDATE branches SET Name = :Name, Address = :Address, SeatCapacity = :SeatCapacity, Tel_no = :Tel_no, Latitude = :Latitude, Longitude = :Longitude WHERE Branch_Id = :Branch_Id", $data);

        return $result ? array('success' => true) : array('Failed to update the branch.');
    }

    public static function delete_branch($id){
        $DB = Database::getInstance();

        $DBdata = array(
            'id' => $id
        );

        
 
        $query = "delete from branches where Branch_Id  = :id";

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