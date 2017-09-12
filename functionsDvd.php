<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/12/2017
 * Time: 7:26 AM
 */

if (!class_exists("dbConnect")) include("dbConnect.php");
include_once ("functionsMain.php");

/**
 * @return array
 */
function getDvd()
{
    $dbConnect = new dbConnect();
    $dvd = array();
    $results = $dbConnect->fetch("
        SELECT dvd.id, dvd.name, dvd.description,dvd.release_date, dvd.category_id, category.category_name
        FROM dvd
        INNER JOIN category ON category.id = dvd.category_id;");
    foreach ($results as $key => $value){
        array_push($dvd, new dvd($value['id'], $value['name'], $value['description'],
            $value['release_date'], $value['category_id'], $value['category_name']));
    }

    return $dvd;
}

/**
 * @param $dvdList array
 * @param $dvdID string
 * @return bool|dvd returns false if no dvd found, otherwise it will return the dvd.
 */
function searchDvd($dvdList, $dvdID){

    foreach ($dvdList as $value){
        if($value->getId() == $dvdID) return $value;
    }
    return false;
}

/**
 * @param $customerOrder array
 * @param $dvd dvd
 * @return array|int
 */
function customerOrderAddDvd($customerOrder, $dvd){
    var_dump($dvd);
    if(!empty($customerOrder )){
        foreach ($customerOrder as $value){
            print_r($value);
            if($value->getId() == $dvd->getId()){
                $value->increaseCount(1);
                return $customerOrder;
            }
        }
    }
    array_push($customerOrder, $dvd);
    return $customerOrder;
}

/**
 *
 */
function dvdTableStart(){
    ?>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
        <th>Release Date</th>
        <th>Genré</th>
        <th>&nbsp;</th>
    </tr>
    <?php
}

/**
 * @param $dvdArray dvd
 */
function dvdTableRow($dvdArray)
{
    echo "<tr>
            <td>" . htmlspecialchars($dvdArray->getId()) . "</td>" . "
            <td>" . htmlspecialchars($dvdArray->getName()) . "</td>" . "
            <td>" . htmlspecialchars($dvdArray->getDescription()) . "</td>" . "
            <td>" . htmlspecialchars($dvdArray->getReleaseDate()) . "</td>" . "
            <td>" . htmlspecialchars($dvdArray->getCategoryName()) . "</td>" . "
            <td> <a href='?id=" . htmlspecialchars($dvdArray->getId()) . "&add=TRUE'>Add</a> 
                <a href='?id=" . htmlspecialchars($dvdArray->getId()) . "&remove=TRUE'>Remove</a>
            </td>" . "
         </tr>";
}

/**
 *
 */
function dvdTableEnd(){
    ?>
</table>
    <?php
}