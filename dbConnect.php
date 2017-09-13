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

        $setQuery = "id = " . $id . ", name = " . $name . ", surname = " . $surname
            . ", contact_number = " . $contact_number . ", email = " . $email . " sa_id_number = " . $sa_id_number
            . ", address = " . $address;


        $query = "UPDATE " . $table . "SET " . $setQuery . " WHERE" . $where;

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

        $values = "'" . $name . "', '". $surname . "', '" . $contact_number . "', '" . $email . "', '" . $sa_id_number . "', '" . $address . "'";

        $columnNames = "name, surname, contact_number, email, sa_id_number, address";
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
        echo htmlentities("'", ENT_QUOTES, 'UTF-8');
        $setQuery = "id = " . $set->getId() . ", name = '" . htmlentities($set->getName(),ENT_QUOTES, 'UTF-8'). "', description = '" . htmlentities($set->getDescription(), ENT_QUOTES, 'UTF-8')
            . "', release = STR_TO_DATE('1998-09-02', '%Y-%m-%d'), category_id = " . $set->getCategoryId();
        echo "<pre>IN DB"; var_dump($setQuery, $table, $where);

        $query = "UPDATE " . $table . " SET " . $setQuery . " WHERE " . $where;
        var_dump($query);

        var_dump($this->conn->query($query), $this->conn);
    }

    /**
     * @param $table
     * @param $set dvd
     * @return bool|mysqli_result
     */
    public function insertDvd($table, $set)
    {
        $values = "'" . $set->getName() . "', '". $set->getDescription() . "', '" . $set->getReleaseDate() . "', '" . $set->getCategoryId() . "'";

        $columnNames = "name, surname, contact_number, email, sa_id_number, address";
        $query = "INSERT INTO " . $table . " (" . $columnNames .") VALUES (" . $values . ");";

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
}