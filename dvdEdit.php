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
$dvdList = getDvd(); //get all DVD's that are not soft-deleted to return.
$categoryList = getCategories(); //get all the categories that the user can select from.


//if the user has selected edit DVD on the DVD page (dvdtable.php). Otherwise no movie will be pre-selected.
if (isset($_GET['id'])) {
    dvdEditForm($dvdList, $categoryList, intval($_GET['id']));
} else {
    dvdEditForm($dvdList, $categoryList);
}


//JQUERY
addScript("/js/dvd-edit.js");

include_once ("html/defaultFooter.html");