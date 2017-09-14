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

//$outstanding = getOutstanding($_SESSION['loggedIn']);
$outstanding = getOutstanding(2);
echo "<pre>";
var_dump($outstanding);
echo "</pre>";

