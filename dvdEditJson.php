<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/13/2017
 * Time: 7:59 AM
 */
header("Content-type: application/json; charset=UTF-8");
include_once ("dvd.php");
include_once ("functionsMain.php");
include_once ("functionsDvd.php");
$myObj = getDvd();

$myJSON = json_encode($myObj);

echo $myJSON;