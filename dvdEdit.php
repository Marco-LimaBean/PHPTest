<?php
/**
 * A page only to edit DVD
 */

$title = "DVD Edit";
include_once ("html/defaultHeader.html");

include_once ("functionsMain.php");
include_once ('functionsDvd.php');
if (!class_exists("category")) include("category.php");
if (!class_exists("dvd")) require("dvd.php");


//print category form:
$dvdList = getDvd();
$categoryList = getCategories();

dvdEditForm($dvdList, $categoryList);

//JQUERY
addScript("/js/dvd-edit.js");

include_once ("html/defaultFooter.html");