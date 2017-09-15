<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/13/2017
 * Time: 10:14 AM
 */

include_once ("functionsDvd.php");

if(!class_exists('dvd')) include_once ("dvd.php");
if(!class_exists('dbConnect')) include_once ("dbConnect.php");
if(!isset($dbConnect)){
    $dbConnect = new dbConnect();
}

if(isset($_POST['dvd'])){
    $dvd = dvdConvertFromJSON($_POST['dvd']);
    if(get_class($dvd) == "dvd"){
        updateDvd($dvd);
        echo "<h4>Your movie has been updated.</h4>";
    } else {
        echo "<h4>An error has occurred, please try again (CODE 1002).</h4>";
    }

}else{
    echo "<h4> An error (CODE 1001) occurred. Please contact the site admin. </h4>";
}


