<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/12/2017
 * Time: 7:24 AM
 */
if (!isset($_SESSION)) session_start();
if (!class_exists("dvd")) include("dvd.php");
if (!class_exists("customerOrder")) include("customerOrder.php");
include("functionsDvd.php");
include_once("functionsMain.php");


//get DVDs list
/** @var array|dvd $dvdList dvdList is an array of dvd objects */
$dvdList = getDvd();

//if delete DVD is clicked
if (isset($_GET['id'], $_GET['remove'])) {
    //make sure the get is correctly set
    if (is_numeric($_GET['id']) && $_GET['remove'] === 'TRUE') {

        echo "starting foreach dvdList";

        foreach ($dvdList as $dvd) {
            if ($_GET['id'] == $dvd->getId()) {
                echo "<br> id found" . $_GET['id'];
                deleteDvd($dvd);
            }
        }

    }
}

//printing out of table
dvdTableStart();

//printing out all the table rows
foreach ($dvdList as $key => $value){
    dvdTableRow($value);
}

//printing out of end of table
dvdTableEnd();

