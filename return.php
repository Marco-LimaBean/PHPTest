<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/14/2017
 * Time: 11:13 AM
 */

$title = "Rental";
include_once('html/defaultHeader.html');
if (!isset($_SESSION)) session_start();

if (isset($_SESSION['loggedIn']) && is_numeric($_SESSION['loggedIn'])) {
    include_once('orderTable.php');
} else {
    include_once('login.php');
}

include_once('html/defaultFooter.html');