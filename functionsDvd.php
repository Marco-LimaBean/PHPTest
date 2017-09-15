<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/12/2017
 * Time: 7:26 AM
 */

if (!class_exists("dbConnect")) include("dbConnect.php");
if (!class_exists("category")) include("category.php");
include_once ("functionsMain.php");

/** Returns all DVD's in the database
 * @return array
 */
function getDvd()
{
    if (!class_exists("dbConnect")) require("dbConnect.php");
    if (!class_exists("dvd")) require("dvd.php");
    $dbConnect = new dbConnect();
    $dvd = array();
    $resultsDvds = $dbConnect->fetch("
        SELECT dvd.id, dvd.name, dvd.description,dvd.release_date, dvd.category_id, category.category_name
        FROM dvd
        INNER JOIN category ON category.id = dvd.category_id", ["isdeleted = 0"]);

    //convert results to array of dvd objects
    foreach ($resultsDvds as $key => $resultDvd) {
        array_push($dvd, new dvd($resultDvd['id'], $resultDvd['name'], $resultDvd['description'],
            $resultDvd['release_date'], $resultDvd['category_id'], $resultDvd['category_name']));
    }


    return $dvd;
}

/** This function will either update or add a new DVD.
 * @param $dvd dvd
 * @param bool $isNew
 * @return bool
 */
function updateDvd($dvd, $isNew = false){
    if (!class_exists("dbConnect")) require("dbConnect.php");
    if (!class_exists("dvd")) require("dvd.php");
    $dbConnect = new dbConnect();
    if ($isNew) {
        return $dbConnect->insertDvd("dvd", $dvd);
    }
    return $dbConnect->updateDvd("dvd", $dvd, "id = " . $dvd->getId());
}

/** Deletes the dvd object.
 * @param $dvd dvd
 * @return mixed
 */
function deleteDvd($dvd)
{
    if (!class_exists("dbConnect")) require("dbConnect.php");
    if (!class_exists("dvd")) require("dvd.php");
    $dbConnect = new dbConnect();

    return $dbConnect->softDelete("`dvd`", "id = " . $dvd->getId());
}

/**
 * @return category[]
 */
function getCategories(){
    $dbConnect = new dbConnect();
    $category = array();
    $results = $dbConnect->fetch("
        SELECT `id`, `category_name`
        FROM category");
    foreach ($results as $key => $value){
        array_push($category, new category($value['id'], $value['category_name']));
    }
    return $category;
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
    if(!empty($customerOrder )){
        foreach ($customerOrder as $value){
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
 * @param $customerOrder array
 * @param $dvd dvd
 * @return array|int
 */
function customerOrderRemoveDvd($customerOrder, $dvd)
{
    if (!empty($customerOrder)) {
        $index = NULL;
        foreach ($customerOrder as $key => $value) {
            if ($value->getId() === $dvd->getId()) {
                $index = $key;
                break;
            }
        }
        if ($index !== NULL) {
            array_splice($customerOrder, $index, 1);
        }

    }
    return $customerOrder;
}

/**
 * @param $dvd
 * @return dvd
 */
function dvdConvertFromJSON($dvd){
    $dvd = json_decode($dvd, true);
    return new dvd($dvd['id'], $dvd['name'], $dvd['description'], $dvd['release_date'], $dvd['category_id'], $dvd['category_name']);
}

/** Echos <table> table headers.
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
 * @param $array
 * @param $post $_POST
 * @param $value
 * @internal param $_POST
 * @return array
 */
function dvdChangeArray($array, $post, $value){
    if($post[$value] == ""){
        return $array;
    }
    return array_merge($array, array($value => $post[$value]));
}

/**
 * @param $dvdList array
 * @param $category category[]
 * @param bool|int $selected
 * @internal param dvd $dvd
 */
function dvdEditForm($dvdList, $category, $selected = false)
{
    ?>
    <div class="dvdEditForm text-center">
        <h1> DVD Edit: </h1>
        <form action="" method="post" id="editDvd">
            <label>Dvd: </label>
            <select name="dvd" required>
                <option value="---" selected disabled> --- </option>
                <?php
                    foreach ($dvdList as $dvd){
                        if ($selected && $selected == $dvd->getId()) {
                            echo "<option selected value='" . htmlspecialchars($dvd->getId()) . "'> " . htmlspecialchars($dvd->getName()) . " (" . htmlspecialchars($dvd->getReleaseDate()) . ")
                        </option>";
                        } else {
                            echo "<option value='" . htmlspecialchars($dvd->getId()) . "'> " . htmlspecialchars($dvd->getName()) . " (" . htmlspecialchars($dvd->getReleaseDate()) . ")
                            </option>";
                        }

                    }

                ?>
            </select>
            <label>New Name: </label>
            <input name="newName" placeholder="The desired name">
            <br>
            <label>Date: </label>
            <input name="date" type="date">
            <label>Category: </label>
            <select name="category">
                <option value="---" selected disabled> --- </option>
                <?php
                    foreach ($category as $value){
                        echo "<option value ='" . $value->getId() . "'> " . $value->getCategory() . "</option>
                        ";
                    }
                ?>
            </select>
            <br>
            <label>New Description*: </label>
            <br>
            <textarea name="description" form="editDVD" title="New Description" cols="60"></textarea>
            <br>
            <input name="reset" type="reset">
            <input name="submitEditDvd" type="submit" value="Edit DVD">
        </form>
        <div class='text-centered'><i> *Note that description will only register 250 characters.</i></div>
        ;
        <div id="message"></div>
    </div>
    <?php
}


/**
 * @param $dvdArray dvd
 * @param bool $inOrder is the value in the customer order
 */
function customerDvdRentalRow($dvdArray, $inOrder = false)
{
    echo "<tr>
            <td>" . htmlspecialchars($dvdArray->getId()) . "</td>" . "
            <td>" . htmlspecialchars($dvdArray->getName()) . "</td>" . "
            <td>" . htmlspecialchars($dvdArray->getDescription()) . "</td>" . "
            <td>" . htmlspecialchars($dvdArray->getReleaseDate()) . "</td>" . "
            <td>" . htmlspecialchars($dvdArray->getCategoryName()) . "</td>";
    if (!$inOrder) {
        echo "<td> 
                <a href='?id=" . htmlspecialchars($dvdArray->getId()) . "&add=TRUE'>Add</a> 
              </td>";
    } else {
        echo "<td>
                <a href='?id=" . htmlspecialchars($dvdArray->getId()) . "&remove=TRUE'>Remove</a>
             </td>";
    }
    echo "</tr>";
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
            <td> <a href='dvdEdit?id=" . htmlspecialchars($dvdArray->getId()) . "'>Edit</a> 
                <a href='?id=" . htmlspecialchars($dvdArray->getId()) . "&remove=TRUE'>Delete</a>
            </td>" . "
         </tr>";
}

/** echos </table>
 *
 */
function dvdTableEnd(){
    ?>
</table>
    <?php
}