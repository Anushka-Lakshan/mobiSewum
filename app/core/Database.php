<?php

Class Database {

    public static $con;
    private static $instance = null;

    public function __construct(){
        try {
            $string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
            self::$con = new PDO($string, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance(){
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    //read
    public function read($query, $data = array())
    {
        $statement = self::$con->prepare($query);
        $result = $statement->execute($data);

        if($result){

            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            if(is_array($data)){
                return $data;
            }
        }

        return false;
    }

    //write
    public function write($query,$data = array()){

        $statement = self::$con->prepare($query);
        $result = $statement->execute($data);

        if($result){
            return true;
        }

        return false;

    }


}
