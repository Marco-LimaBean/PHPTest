<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/8/2017
 * Time: 1:32 PM
 */

class dbConnect
{
    private $host, $user, $password, $database, $conn;

    /**
     * mysqli_database constructor.
     * @param $host
     * @param $user
     * @param $password
     * @param $database
     */
    public function __construct($host = "127.0.0.1", $user = "root", $password = "", $database = "dvd_shop")
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

    public function fetch($query)
    {
        $sql = $this->conn->query($query);
        $result = array();
        while ($row = mysqli_fetch_assoc($sql)) {
            array_push($result, $row);
        }
        $sql->close();
        return $result;
    }

    /**
     * @param $table
     * @param $set array of customer
     * @param $where
     * @return bool|mysqli_result
     */
    public function update($table, $set, $where)
    {
        $id = $set->getId();
        $name = $set->getName();
        $surname = $set->getSurname();
        $contact_number = $set->getContactNumber();
        $email = $set->getEmail();
        $sa_id_number = $set->getSaIdNumber();
        $address = $set->getAddress();

        $setQuery = "id = " . $id . ", name = " . $name . ", surname = " . $surname
            . ", contact_number = " . $contact_number . ", email: " . $email . " sa_id_number = " . $sa_id_number
            . ", address = " . $address;


        $query = "UPDATE " . $table . "SET " . $setQuery . " WHERE" . $where;

        return $this->conn->query($query);
        //TODO: make sure that the return is true/false;
    }

    public function insert($table, $set){
        $name = $set->getName();
        $surname = $set->getSurname();
        $contact_number = $set->getContactNumber();
        $email = $set->getEmail();
        $sa_id_number = $set->getSaIdNumber();
        $address = $set->getAddress();

        $values = "'" . $name . "', '". $surname . "', '" . $contact_number . "', '" . $email . "', '" . $sa_id_number . "', '" . $address . "'";

        $i = 1; //counter for columnNames.
        $columnNames = "name, surname, contact_number, email, sa_id_number, address";
        $query = "INSERT INTO " . $table . " (" . $columnNames .") VALUES (" . $values . ");";

        return $this->conn->query($query);
    }

    public function delete($table, $where)
    {
        return $this->conn->query("DELETE FROM " . $table . " WHERE " . $where);
    }

}