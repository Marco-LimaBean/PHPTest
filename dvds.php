<?php
ob_start();

$title = "DVD";
include_once("html/defaultHeader.html");
include ("dvdTable.php");
include_once ("html/defaultFooter.html");

ob_end_flush();