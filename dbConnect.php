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

    /**
     * @param $query
     * @param array $where
     * @param string $condition
     * @return array
     */
    public function fetch($query, $where =[], $condition = ' AND ')
    {
        if(is_string($where)) {
            $where = [$where];
        }

        if($where) {
            $query .= ' WHERE ';
            $query .= implode($condition, $where);
        }

        $sql = $this->conn->query($query);
        $result = array();
        while ($row = mysqli_fetch_assoc($sql)) {
            array_push($result, $row);
        }
        $sql->close();
        return $result;
    }


    /**
     * @param $username
     * @return bool
     */
    public function customerLogin($username)
    {
        try {
            $result = mysqli_fetch_assoc($this->conn->query("SELECT password FROM customer WHERE id = " . intval($username)));
            return $result['password'];
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $table
     * @param $set customer array of customer
     * @param $where
     * @return bool|mysqli_result
     */
    public function updateCustomer($table, $set, $where)
    {
        $id = $set->getId();
        $name = $set->getName();
        $surname = $set->getSurname();
        $contact_number = $set->getContactNumber();
        $email = $set->getEmail();
        $sa_id_number = $set->getSaIdNumber();
        $address = $set->getAddress();

        $setQuery = "`id` = " . $id . ", `name` = '" . addslashes($name) . "', `surname` = '" . addslashes($surname)
            . "', `contact_number` = '" . $contact_number . "', `email` = '" . addslashes($email) . "', `sa_id_number` = " . $sa_id_number
            . ", `address` = '" . addslashes($address) . "' ";


        $query = "UPDATE " . $table . " SET " . $setQuery . " WHERE " . $where;

        return $this->conn->query($query);
    }

    /**
     * @param $table
     * @param $set customer
     * @return bool|mysqli_result
     */
    public function insertCustomer($table, $set){
        $name = $set->getName();
        $surname = $set->getSurname();
        $contact_number = $set->getContactNumber();
        $email = $set->getEmail();
        $sa_id_number = $set->getSaIdNumber();
        $address = $set->getAddress();

        $values = "'" . addslashes($name) . "', '" . addslashes($surname) . "', '" . $contact_number . "', '"
            . addslashes($email) . "', '" . $sa_id_number . "', '" . addslashes($address) . "'";

        $columnNames = "`name`, `surname`, `contact_number`, `email`, `sa_id_number`, `address`";
        $query = "INSERT INTO " . $table . " (" . $columnNames .") VALUES (" . $values . ");";

        return $this->conn->query($query);
    }

    /**
     * @param $table
     * @param $set dvd array of dvd
     * @param $where
     * @return bool|mysqli_result
     */
    public function updateDvd($table, $set, $where)
    {
        $setQuery = "`id` = " . $set->getId() . ", `name` = \"" . addslashes($set->getName()) . "\", 
        `description` = '" . addslashes($set->getDescription()) . "', `release_date` = '" . $set->getReleaseDate()
            . "', `category_id` = " . $set->getCategoryId();

        $query = "UPDATE " . $table . " SET " . $setQuery . " WHERE " . $where;

        return $this->conn->query($query);
    }

    /**
     * @param $table
     * @param $set dvd
     * @return bool|mysqli_result
     */
    public function insertDvd($table, $set)
    {
        $values = "'" . addslashes($set->getName()) . "', '" . addslashes($set->getDescription()) . "', '" . $set->getReleaseDate() . "', '" . $set->getCategoryId() . "'";

        $columnNames = "`name`, `description`, `release_date`, `category_id`";
        $query = "INSERT INTO " . $table . " (" . $columnNames .") VALUES (" . $values . ");";

        return $this->conn->query($query);
    }

    /**
     * @param $table
     * @param $set orderLine
     * @return bool|mysqli_result
     */
    public function insertOrder($table, $set)
    {
        $values = "'" . addslashes($set->getCustomerId()) . "', '" . addslashes($set->getDueDate()) . "', '" . $set->getRentDate() . "'";

        $columnNames = "`customer_id`, `due_date`, `rent_date`";
        $query = "INSERT INTO " . $table . " (" . $columnNames . ") VALUES (" . $values . ");";

        $this->conn->query($query);
        var_dump($this->conn);
        return $this->conn->query($query);
    }

    /**
     * @param $table
     * @param $where
     * @return bool|mysqli_result
     */
    public function delete($table, $where)
    {
        return $this->conn->query("DELETE FROM " . $table . " WHERE " . $where);
    }

    /**
     * @param $table
     * @param $set orderLine;
     * @return bool|mysqli_result
     */
    public function updateOrder($table, $set)
    {
        $values = "'" . addslashes($set->getCustomerId()) . "', '" . addslashes($set->getDueDate()) . "', '" . $set->getRentDate() . "'";

        $columnNames = "`customer_id`, `due_date`, `rent_date`";
        $query = "INSERT INTO " . $table . " (" . $columnNames . ") VALUES (" . $values . ");";

        $this->conn->query($query);
        var_dump($this->conn);
        return $this->conn->query($query);
    }

}