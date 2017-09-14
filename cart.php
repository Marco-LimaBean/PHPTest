<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/14/2017
 * Time: 9:22 AM
 */

if (!isset($_SESSION)) session_start();
$title = "Cart";
include_once('html/defaultHeader.html');

if (isset($_SESSION['sCustomerOrder']) && strlen($_SESSION['sCustomerOrder']) > 6) {
    //show the page as the user does have a cart order.
    include_once('customerCart.php');
} else {
    header("LOCATION: rental");
}

include_once('html/defaultFooter.html');