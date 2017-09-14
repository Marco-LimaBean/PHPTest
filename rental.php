<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/13/2017
 * Time: 3:59 PM
 */

$title = "Rental";
include_once('html/defaultHeader.html');
if (!isset($_SESSION)) session_start();

if (isset($_SESSION['loggedIn']) && is_numeric($_SESSION['loggedIn'])) {
    include_once('customerRental.php');
} else {
    include_once('login.php');
}

include_once('html/defaultFooter.html');