<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/8/2017
 * Time: 1:32 PM
 */

$conn = mysqli_connect("127.0.0.1", "root", "", "dvd_shop");


class dbConnect{
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

        $this->conn =  mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

    public function fetch($query){
        $sql = $this->conn->query($query);
        $result = array();
        while($row = mysqli_fetch_assoc($sql)) {
            array_push($result, $row);
        }
        $sql->close();
        return $result;
    }

    public function update($table, $set, $where){
        $query = "UPDATE " . $table . "SET " . $set . " WHERE" . $where;
        return $this->conn->query($query);
    }

}