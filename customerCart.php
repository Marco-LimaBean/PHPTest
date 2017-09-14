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
include_once('functionsOrder.php');

//get customer list
if (!isset($customerOrder) || $customerOrder == NULL) {
    if (isset($_SESSION['sCustomerOrder'])) $customerOrder = unserialize($_SESSION['sCustomerOrder']);
    else $customerOrder = array(); //in case there is no customerOrder list.
}

dvdTableStart();
var_dump($customerOrder);
foreach ($customerOrder as $value) {
    cartTableRow($value);
}

dvdTableEnd();

//user clicked on checkout and accepts the cart items
if (isset($_POST['submitCart']) && $_POST = "Checkout") {

    //first create the order object:
    $order = new orderLine($_SESSION['loggedIn'],
        date('Y-m-d', time()),
        date('Y-m-d',
            strtotime(date('Y-m-d', time()) . "+ 14 days")
        )
    );

    //"submit" to the database
    updateOrderLine($order);

    //get the order's id to rent out the specific dvd's.
    $order->setOrderId(getNewestCustomerOrderId($_SESSION['loggedIn']));

    //update database table wit the new dvd order items.

    //checkout item's for each dvd in the array save the dvd and the customer id to the db.
    foreach ($customerOrder as $orderDvd) {
        echo "<pre>";
        var_dump($customerOrder);
        updateDvdOrder($orderDvd->getDvdId(), $order->getOrderId());
    }

    //after completion, tell the user it has succeeded, clear out the cart and redirect to the return rental page.
    jsAlert("Checkout succeeded");
    unset($_SESSION['sCustomerOrder']);
    redirect("return");


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
