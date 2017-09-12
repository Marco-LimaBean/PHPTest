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
dvdEditForm(getDvd(), getCategories());

if(isset($_POST['submitEditDvd'], $_POST['dvd'])){
    //need to check each form item individually as only those with a value entered are the ones to change.

    $changeArray = array();

    if(isset($_POST['newName']) && is_string($_POST['newName'])){
//        array_merge($changeArray, array('newName' => $_POST['newName']));
        echo "<pre>";
        var_dump(dvdChangeArray($changeArray, $_POST, 'newName'));
        echo "</pre>";
    }
}

//JQUERY


include_once ("html/defaultFooter.html");