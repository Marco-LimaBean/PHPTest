<?php
if(!isset($_SESSION)) session_start();
$title = "Customers";
include("functionsMain.php");
include("html/defaultHeader.html");

include("customerTable.php");


include("html/defaultFooter.html");
