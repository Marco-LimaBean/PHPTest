<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/13/2017
 * Time: 4:03 PM
 */

if (!isset($_SESSION)) session_start();
if (!class_exists("customer")) include_once("customer.php");
if (!class_exists("dvd")) include_once("dvd.php");

include_once("functionsMain.php");
include_once('functionsDvd.php');
include_once('functionsCustomer.php');

//get customer list
if (!isset($customerOrder) || $customerOrder == NULL) {
    if (isset($_SESSION['sCustomerOrder'])) $customerOrder = unserialize($_SESSION['sCustomerOrder']);
    else $customerOrder = array(); //in case there is no customerOrder list.
}


/*
 * DISPLAY PAGE
 */

echo "<h3> Dvd Rental: </h3>";

//get DVD to display
$dvdList = getDvd();
dvdTableStart();

foreach ($dvdList as $value) {
    if (!empty($customerOrder) && in_array($value, $customerOrder)) {
        customerDvdRentalRow($value, true);
        continue;
    }
    customerDvdRentalRow($value);
}

dvdTableEnd();

/*
 * END OF DISPLAY
 */

//if customer requests to add DVD to list:
if (isset($_GET['id'], $_GET['add'])) {
    $dvd = searchDvd($dvdList, $_GET['id']);
    if ($dvd) { //add dvd if the dvd id is valid.
        $customerOrder = customerOrderAddDvd($customerOrder, $dvd);
        redirectQuery("");

    } else {
        echo "invalid DVD ID specified";
    }
}

//if a customer wants to remove the DVD from the list.
if (isset($_GET['id'], $_GET['remove'])) {
    $dvd = searchDvd($dvdList, $_GET['id']);
    if ($dvd) { //remove dvd if the dvd id is valid.
        $customerOrder = customerOrderRemoveDvd($customerOrder, $dvd);
        redirectQuery("");

    } else {
        echo "invalid DVD ID specified";
    }
}

//Serialization
$_SESSION['sCustomerOrder'] = serialize($customerOrder);