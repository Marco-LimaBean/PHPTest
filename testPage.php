<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/11/2017
 * Time: 1:35 PM
 */

if(!class_exists("dbConnect")) require ("dbConnect.php");
if(!class_exists("customer")) require ("customer.php");
$dbConnect = new dbConnect();
$results = $dbConnect->fetch("SELECT * FROM customer;");

$customer = array();

foreach($results as $value){
    array_push($customer,
        new Customer($value['id'], $value['name'], $value['surname'], $value['contact_number'],
            $value['email'], $value['sa_id_number'], $value['address']));
}
