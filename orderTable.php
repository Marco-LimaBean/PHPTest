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
$outstandingOrders = getOutstanding($_SESSION['loggedIn']); //Note it's an array of orderLine items.
//if the user wants to return an item:
if (isset($_GET['orderId']) && !empty($outstandingOrders)) {
    //first check that the submitted get is a valid number (numeric and in list)
    if (is_numeric($_GET['orderId'])) {
        //if the ID is in the list of outstanding items:
        foreach ($outstandingOrders as $order) {
            /** @var orderLineItem $order */
            if ($order->getOrderId() == $_GET['orderId']) {
                $order->setActualReturnDate(date('Y-m-d', time()));
                //submit updated order to database:
                updateOrderLine($order);
                redirectQuery("");
                break;
            }
        }
    }
}
/*
 * Display
 */

//Heading:
echo "<h3> Return Rentals: </h3>";

if ($outstandingOrders) { //if there are outstanding items.
    orderTableStart();

    foreach ($outstandingOrders as $orderLine) {

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
