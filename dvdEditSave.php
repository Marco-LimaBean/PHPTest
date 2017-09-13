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
    echo "<h4>checks passed</h4>";

    $dvd = dvdConvertFromJSON($_POST['dvd']);
    if(get_class($dvd) == "dvd"){
        updateDvd($dvd);
        echo "Update occurred. <br>";
        echo "new DVD List:<br>";
        echo "<pre>";
        var_dump(getDvd());
        echo "<br> Given DVD:";
        var_dump($dvd);
        echo "</pre>";
    }

}else{
    echo "<h4> An error (CODE 1001) occurred. Please contact the site admin. </h4>";
}


