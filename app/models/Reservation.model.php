<?php 

Class Reservation
{


	public static function get_all()
	{

		$DB = Database::getInstance();
		return $DB->read("select reservations.*,branches.Name AS 'branch_name' from reservations inner join 
        branches on reservations.Branch_Id = branches.Branch_Id order by id desc");

	}

    public static function get_Reservation_by_id($id)
	{

		$DB = Database::getInstance();

        return $DB->read("select reservations.*,branches.Name AS 'branch_name' from reservations
         inner join branches on reservations.Branch_Id = branches.Branch_Id where reservations.id = :id limit 1", array('id' => $id));

	}

    public static function get_Reservation_by_customer($id)
	{

		$DB = Database::getInstance();

        return $DB->read("select reservations.*,branches.Name AS 'branch_name' from reservations inner join branches on reservations.Branch_Id = branches.Branch_Id where reservations.Customer_id = :id order by reservations.id desc", array('id' => $id));

        //SELECT orders.*, branches.Name AS 'branch_name' FROM orders INNER JOIN branches ON orders.branch_id = branches.Branch_Id WHERE orders.customer_id = 1 ORDER BY orders.id DESC

	}

    public static function get_Persons_by_time($branchId,$date,$time)
	{

		$DB = Database::getInstance();

        $DBdata = array(
            'branchId' => $branchId,
            'date' => $date,
            'time' => $time
        );

        $query = "SELECT SUM(persons) as totalPersons
                    FROM reservations
                    WHERE Branch_Id = :branchId
                    AND date = :date
                    AND TIMEDIFF(time, :time) BETWEEN '-00:30:00' AND '00:30:00';";

        return $DB->read($query, $DBdata);

	}

    public static function add_reservation($branchId, $date, $time, $persons, $email, $fname, $phone, $msg){

        $DB = Database::getInstance();

        $DBdata = array(
            'branchId' => $branchId,
            'Customer_id' => isset($_SESSION['Customer_Id']) ? $_SESSION['Customer_Id'] : 0,
            'date' => $date,
            'time' => $time,
            'persons' => $persons,
            'email' => $email,
            'fname' => $fname,
            'phone' => $phone,
            'msg' => $msg
        );

        $query = "INSERT INTO reservations (Branch_Id, Customer_id, date, time, persons, email, name, phone, note) VALUES (:branchId, :Customer_id, :date, :time, :persons, :email, :fname, :phone, :msg)";

        return $DB->write($query, $DBdata);


    }

    public static function update_reservation_status($reservationId, $newStatus, $change_by) {
        $DB = Database::getInstance();
    
        $query = "UPDATE reservations SET status = :new_status , Confirmed_by = :change_by WHERE id = :reservation_id";
        $params = array('new_status' => $newStatus, 'reservation_id' => $reservationId, 'change_by' => $change_by);
    
        $result = $DB->write($query, $params);
    
        if ($result) {
            return array('success' => true);
        } else {
            return array('Failed to update reservation status.');
        }
    }
    

	
}