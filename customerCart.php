<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/14/2017
 * Time: 9:26 AM
 */

if (!isset($_SESSION)) session_start();
if (!class_exists("customer")) include_once("customer.php");
if (!class_exists("dvd")) include_once("dvd.php");
if (!class_exists("orderLine")) include_once("orderLine.php");

include_once("functionsMain.php");
include_once('functionsDvd.php');
include_once('functionsCustomer.php');
include_once('functionsCart.php');

//get customer list
if (!isset($customerOrder) || $customerOrder == NULL) {
    if (isset($_SESSION['sCustomerOrder'])) $customerOrder = unserialize($_SESSION['sCustomerOrder']);
    else $customerOrder = array(); //in case there is no customerOrder list.
}

dvdTableStart();

foreach ($customerOrder as $value) {
    cartTableRow($value);
}

dvdTableEnd();

if (isset($_POST['submitCart']) && $_POST = "Checkout") {
    $order = new orderLine($_SESSION['loggedIn'], date('Y-m-d', time()),
        date('Y-m-d', strtotime(time() + strtotime("+14 days"))));
    updateOrderLine($order);
}


/*
 * Cart submit:
 */

?>
    <br>
    <form action="" method="post" class="text-center">
        <input name="submitCart" type="submit" value="Checkout">
    </form>
<?php
