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
if(!isset($dvdList)){
    //could store this in session, but would need to make autoload function in DVD, which is over scope.
    $dvdList = getDvd();
}

//get customer list
if(!isset($customerOrder) || $customerOrder == NULL){
    if(isset($_SESSION['sCustomerOder'])) $customerOrder = unserialize($_SESSION['sCustomerOder']);
    else $customerOrder = array(); //in case there is no customerOrder list.
}

//if customer requests to add DVD to list:
if(isset($_GET['id'], $_GET['add'])){
    echo "<br> SearchDVD: " . var_dump(searchDvd($dvdList, $_GET['id'])) . "<br>";
    if(($dvd = searchDvd($dvdList, $_GET['id']))){ //add dvd if the dvd id is valid.
        echo "<br>DVD: <br>" . var_dump($dvd) . " &nbsp; END<br>";
        //loop through customer order to check if the dvd id has already been added.
        $customerOrder = customerOrderAddDvd($customerOrder, $dvd);
    }else{
        echo "invalid DVD ID specified";
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


//Seialization
$_SESSION['sCustomerOder'] = serialize($customerOrder);