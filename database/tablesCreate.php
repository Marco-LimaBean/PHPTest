<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/8/2017
 * Time: 1:40 PM
 */

//database connection initiation
include("dbConnect.php");

echo $conn->client_info;

//customer table creation
$sqlCreateCustomer = "CREATE TABLE customer (
  id INT(6) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  surname VARCHAR(255),
  contact_number VARCHAR(18),
  email VARCHAR(255),
  sa_id_number CHAR(13),
  address VARCHAR(255)
  )";

$conn->query($sqlCreateCustomer);
echo "<br>";
var_dump($conn);

//dummy data
$sqlCustomer = $conn->prepare("INSERT INTO customer (name, surname, contact_number, email, sa_id_number, address)
VALUES (?, ?, ?, ?, ?, ?)");

$fName = "fFirst";
$sName = "sFirst";
$tel = "+27123456789";
$email = "first@gmail.com";
$tel = "0123456789012";
$address = "14 Limabean";
$sqlCustomer->bind_param("ssssss", $fName, $sName, $tel, $email, $tel, $address);

for($i = 0; $i < 10; $i++) {
    $sqlCustomer->execute();
    $fName++;
    $sName++;
    $tel++;
    //email will always be kept the same to keep valid.
    $tel++;
    $address++;
}

//close connection
$conn->close();
