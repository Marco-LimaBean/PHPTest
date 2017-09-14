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