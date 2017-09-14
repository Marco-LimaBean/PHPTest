<?php

/** Gets outstanding order items. It will return it all as an array of orderLineItem object(s) or false if none are found.
 * @param $customerId
 * @return array|bool
 */
function getOutstanding($customerId)
{
    if (!class_exists("dbConnect")) require("dbConnect.php");
    if (!class_exists("orderLine")) require("orderLine.php");

    if (!isset($dbConnect)) {
        if (!class_exists("dbConnect")) include('dbConnect.php');
        $dbConnect = new dbConnect();
    }

    $resultsOutstandingItems = $dbConnect->fetch("SELECT  `order`.id, `order`.customer_id, `order`.`rent_date`, 
                                        `order`.`due_date`, `order`.`actual_return_date`, dvd_order_line.`dvd_id`, `dvd`.`name`
                                    FROM `order` 
                                    INNER JOIN dvd_order_line ON dvd_order_line.`order_id` = `order`.`id` 
                                    INNER JOIN `dvd` ON `dvd`.`id` = dvd_order_line.`dvd_id`",
        "order.customer_id = $customerId", "order.actual_return_date IS NULL");


    if (!empty($resultsOutstandingItems)) {//if there are results
        //convert to array of orderLine. Due to results being individual for every dvd, it needs to be merged for one order line.

        $outstandingOrderLine = array(); //store all orderLine items

        //foreach loop to go through every item
        foreach ($resultsOutstandingItems as $outstandingItem) {

            $found = false; //to check if the orderLine item with the corresponding orderId has already been found.

            //search through previous outstandingOrderLine items for matches.
            foreach ($outstandingOrderLine as $key => $orderLine) {
                if ($outstandingItem['id'] === $orderLine->getOrderId()) {
                    //if an outstanding orderLineItem belonging to an order that already exists has been found:
                    //get the previous DVD Short (name, id) array and add the new DVD Short to it.
                    $outstandingOrderLine[$key]->setDvdShortArray(
                        array_merge(
                            $outstandingOrderLine[$key]->getDvdShortArray(),
                            [new dvdShort($outstandingItem['dvd_id'], $outstandingItem['name'])]
                        )
                    );
                    $found = true; //it has been found, break out of loop
                    break;
                }
            }

            if (!$found) { //if the orderLine item order_id has not been found, a new order item has to be added.
                array_push(
                    $outstandingOrderLine,
                    new orderLineItem(
                        $outstandingItem['id'],
                        $outstandingItem['customer_id'],
                        $outstandingItem['rent_date'],
                        $outstandingItem['due_date'],
                        $outstandingItem['actual_return_date'],
                        [
                            new dvdShort(
                                $outstandingItem['dvd_id'],
                                $outstandingItem['name']
                            )
                        ]
                    )
                );
            }

        }

        //return all outstanding order line items.
        return $outstandingOrderLine;
    } else {
        //no results were found
        return false;
    }
}


/** Selects the highest order id associated with that customer.
 * @param $customerId int
 * @return int
 */
function getNewestCustomerOrderId($customerId)
{
    if (!class_exists("dbConnect")) require("dbConnect.php");
    if (!class_exists("orderLine")) require("orderLine.php");

    if (!isset($dbConnect)) {
        if (!class_exists("dbConnect")) include('dbConnect.php');
        $dbConnect = new dbConnect();
    }

    $where = ["`order`.`customer_id` = " . $customerId];
    $resultMaxOrder = $dbConnect->fetch("SELECT max(`order`.`id`) FROM `order`", $where);
    $resultMaxOrder = array_values($resultMaxOrder[0]); //can't seem to refer by id?
    return $resultMaxOrder[0]; //return only the result id.
}

/** Top of the table rental return table
 *
 */
function orderTableStart()
{
    ?>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Rental Date</th>
            <th>Due Date</th>
            <th>Movies</th>
            <th>Days Outstanding</th>
            <th>&nbsp;</th> <!--actions-->
        </tr>
    <?php
}

/** Prints out a row for every outstanding item.
 * It will display rented DVD's in its own column, displaying all DVD's associated with the order
 *
 * @param $outstandingItem orderLineItem
 */
function orderTableItem($outstandingItem)
{

    echo "<tr>
                <td>" . htmlspecialchars($outstandingItem->getOrderId()) . "</td>
                <td> " . htmlspecialchars($outstandingItem->getRentDate()) . "</td>
                <td> " . htmlspecialchars($outstandingItem->getDueDate()) . "</td>
                <td>" . orderTableItemDVDBullets($outstandingItem->getDvdShortArray()) . " </td>
                <td>" . htmlspecialchars(getDaysOutstanding($outstandingItem->getDueDate())) . "</td>
                <td> <a href='?orderId=" . htmlspecialchars($outstandingItem->getOrderId()) . "'>Return</a></td>
            </tr>";

}

/** returns a string value of the given DVDShort array as a bullet list.
 * @param $dvdList dvdShort
 * @return string
 */
function orderTableItemDVDBullets($dvdList)
{

    $bulletList = "<ul>
";

    foreach ($dvdList as $dvdItem) {
        $bulletList .= orderTableItemDVDListItem($dvdItem);
    }

    $bulletList .= "</ul>";
    return $bulletList;
}

/** Returns the dvd item's name wrapped in <li> tags
 * @param $dvd dvdShort
 * @return string <li> dvd's name </li>
 */
function orderTableItemDVDListItem($dvd)
{
    return ("<li> " . htmlspecialchars($dvd->getName()) . " </li>
");
}

/** Echoes the end of the order table
 *
 */
function orderTableEnd()
{
    echo "</table>";
}


/** Returns either none - due in # days or # of days
 * @param $date
 * @return float
 */
function getDaysOutstanding($date)
{
    $dateDifference = getDayDifference($date);
    if ($dateDifference > 0) {
        return htmlspecialchars($dateDifference) . " days ago";
    } else if ($dateDifference == 0) {
        return "0 - Due Today";
    } else { //isn't due
        return "None - Due in " . htmlspecialchars($dateDifference * -1) . " days.";
    }
}

