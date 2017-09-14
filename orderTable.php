<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/14/2017
 * Time: 11:16 AM
 */

if (!isset($_SESSION)) session_start();
if (!class_exists("customer")) include_once("customer.php");
if (!class_exists("dvd")) include_once("dvd.php");
if (!class_exists("orderLine")) include_once("orderLine.php");

include_once("functionsMain.php");
include_once('functionsDvd.php');
include_once('functionsCustomer.php');
include_once('functionsCart.php');
include_once('functionsOrder.php');

//get outstanding orders (movies that haven't been returned) from the logged in user:
$outstanding = getOutstanding($_SESSION['loggedIn']);
/*
 * Display
 */

if ($outstanding) { //if there are outstanding items.
    orderTableStart();

    foreach ($outstanding as $orderLine) {

        orderTableItem($orderLine);
    }

    orderTableEnd();
} else {
    //if there are no outstanding items

    echo "<h3> You have no rentals to return. </h3>";
}


/*
 * /DISPLAY
 */

