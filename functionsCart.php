<?php


/**
 * @param $dvd dvd
 */
function cartTableRow($dvd)
{
    echo "<tr>
            <td>" . htmlspecialchars($dvd->getId()) . "</td>" . "
            <td>" . htmlspecialchars($dvd->getName()) . "</td>" . "
            <td>" . htmlspecialchars($dvd->getDescription()) . "</td>" . "
            <td>" . htmlspecialchars($dvd->getReleaseDate()) . "</td>" . "
            <td>" . htmlspecialchars($dvd->getCategoryName()) . "</td>" . "
         </tr>";
}

/**
 * @param $customerOrderList array dvd
 */
function updateOrder($customerOrderList)
{
    if (!isset($dbConnect)) {
        if (!class_exists("dbConnect")) include('dbConnect.php');
        $dbConnect = new dbConnect();
    }
    //get an order ID:
    $dbConnect->fetch("");


    foreach ($customerOrderList as $value) {
        echo $value;
        break;
    }
}

/**
 * @param $orderLine orderLine
 * @return bool|mysqli_result
 */
function updateOrderLine($orderLine)
{
    if (!isset($dbConnect)) {
        if (!class_exists("dbConnect")) include('dbConnect.php');
        $dbConnect = new dbConnect();
    }
    if (!class_exists("orderLine")) {
        include('orderLine.php');
    }

    if (!$orderLine->getOrderId()) { //new order
        return $dbConnect->insertOrder("order_line", $orderLine);
    } else {
        return $dbConnect->updateOrder("order_line", $orderLine, "id = " . $orderLine->getOrderId());
    }
}


/** Inserts a dvd ID and order ID into the given table (default = dvd_order_line table)
 * @param $dvdId
 * @param $orderId
 * @param $table
 * @return bool|mysqli_result
 */
function updateDvdOrder($dvdId, $orderId, $table = "dvd_order_line table")
{
    if (!isset($dbConnect)) {
        if (!class_exists("dbConnect")) include('dbConnect.php');
        $dbConnect = new dbConnect();
    }

    return $dbConnect->insertDvdOrder($dvdId, $orderId, $table);
}