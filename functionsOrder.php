<?php

/** Gets outstanding order items. Note that each will be gotten as an object
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

    $results = $dbConnect->fetch("SELECT  order_line.id, order_line.customer_id, order_line.rent_date, 
                                        order_line.due_date, order_line.actual_return_date, dvd_order.dvd_id, dvd.name
                                    FROM order_line 
                                    INNER JOIN dvd_order ON dvd_order.order_id = order_line.id 
                                    INNER JOIN dvd ON dvd.id = dvd_order.dvd_id",
        "order_line.customer_id = $customerId", "order_line.actual_return_date IS NULL");

    echo "<pre>";

    if (!empty($results)) {//if there are results
        //convert to array.
        $outstandingItem = array();
        foreach ($results as $value) {

            foreach ($outstandingItem as $key => $iValue) {
                echo $key . " " . $value['id'] . " " . $iValue->getOrderId();
                if ($value['id'] === $iValue->getOrderId()) {
                    echo "Value: " . $iValue['id'] . " found in array";
                    $outstandingItem[$key]->setDvdShort(array_merge($outstandingItem[$key]->getDvdShort(),
                        array(new dvdShort($value['dvd_id'], $value['name']))));
                    break;
                }
            }
            array_push($outstandingItem, new orderLineItem($value['id'], $value['customer_id'], $value['rent_date'],
                $value['due_date'], $value['actual_return_date'], array(new dvdShort($value['dvd_id'], $value['name']))));
        }
        echo "</pre>";
        return $outstandingItem;
    } else {
        return false;
    }
}