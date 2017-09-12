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
include("functionsMain.php");

//get DVDs list
if(!isset($dvdList)){
    //could store this in session, but would need to make autoload function in DVD, which is over scope.
    $dvdList = getDvd();
}

//get DVDs list
//get DVDs list


//if customer requests to add DVD to list:
if(isset($_GET['id'], $_GET['add'])){
    if(!isset($customerOrder)){
        //could store this in session, but would need to make autoload function in DVD, which is over scope.
        $customerOrder = array();
    }



    array_push($customerOrder, $dvdList);

}







//printing out of table
dvdTableStart();

//printing out all the table rows
foreach ($dvdList as $key => $value){
    dvdTableRow($value);
}

//printing out of end of table
dvdTableEnd();
