<?php

include_once("functionsMain.php");

/** used to check if the customer class exists, if not, it will include it.
 *
 */
function classCustomer()
{
    if (!class_exists("customer")) {
        include("customer.php");
    }
}

/** used to check if the dbConnect class exists, if not, it will include it.
 *
 */
function classDatabase()
{
    if (!class_exists("dbConnect")) {
        include("dbConnect.php");
    }
}


/** Class to get customers according to where.
 * @param array $where
 * @param string $condition default AND, define ' OR '
 * @return array Customer
 * @internal param string $Where this is the where clause. Use e.g. 1=1 for all results.
 */
function getCustomer($where = [], $condition = ' AND ')
{
    if (!class_exists("dbConnect")) require("dbConnect.php");
    if (!class_exists("customer")) require("customer.php");
    $dbConnect = new dbConnect();

    $results = $dbConnect->fetch("SELECT * FROM customer ", $where, $condition);

    $customer = array();

    foreach ($results as $value) {
        array_push($customer,
            new Customer($value['name'], $value['surname'], $value['contact_number'],
                $value['email'], $value['sa_id_number'], $value['address'], $value['id']));
    }
    return $customer;
}

/** Function for login check. Note to save their ID to SESSION['loggedIn']
 * @param $username string
 * @param $password string DO NOT UN HASH THIS. THE FUNCTION DOES IT FOR YOU
 * @param bool $customer to help if one wishes to avoid the checks/site admin tests.
 * @return bool
 */
function login($username, $password, $customer = true)
{
    if (!isset($dbConnect)) {
        if (!class_exists("dbConnect")) include('dbConnect.php');
        $dbConnect = new dbConnect();
    }

    if ($customer) {
        $hash = $dbConnect->customerLogin($username);
        return password_verify($password, $hash);
    }
    return false;
}

/** Either updates or creates a new customer based on the given customer array.
 * @param $customer customer
 * @return bool|mysqli_result
 */
function updateCustomer($customer)
{
    if (!isset($dbConnect)) {
        if (!class_exists("dbConnect")) include('dbConnect.php');
        $dbConnect = new dbConnect();
    }

    if (!$customer->getId()) {
        return $dbConnect->insertCustomer("customer", $customer);
    } else {
        return $dbConnect->updateCustomer("customer", $customer, "id = " . $customer->getId());
    }
}

/** Deletes a customer with the given ID.
 * @param $id
 * @return bool|mysqli_result
 */
function deleteCustomer($id)
{
    if (!isset($dbConnect)) {
        if (!class_exists("dbConnect")) include('dbConnect.php');
        $dbConnect = new dbConnect();
    }

    return $dbConnect->delete("customer", "id = " . $id);
}


/** Function is for a row of customers.
 * @param $customerArray customer an array of the customer class/
 */
function customerTableRow($customerArray)
{

    echo "<tr>";
    tableRowTD($customerArray->getId());
    tableRowTD($customerArray->getName());
    tableRowTD($customerArray->getSurname());
    tableRowTD($customerArray->getContactNumber());
    tableRowTD($customerArray->getEmail());
    tableRowTD($customerArray->getSaIdNumber());
    tableRowTD($customerArray->getAddress());

    echo "<td> <a href='?id=" . htmlspecialchars($customerArray->getId()) . "'>edit</a> 
               <a href='?id=" . htmlspecialchars($customerArray->getId()) . "&delete=TRUE'>delete</a>
          </td>" . "
         </tr>";
}

/** Generates an editable row of customers.
 * @param $customerArray customer
 */
function customerTableRowEdit($customerArray)
{
    echo "<tr>
                <form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>
                    <td> 
                        " . htmlspecialchars($customerArray->getId()) . "
                    </td>";
    customerTableRowEditFields($customerArray);
    echo "<td>
                <input type='submit' name='updateCustomer' value='save'> 
                <input type='submit' name='deleteCustomer' value='delete'>
                <input type='hidden' name='id' value='" . htmlspecialchars($customerArray->getId()) . "'>
            </td>" . "
        </form>
    </tr>";

}

/** Generates table row editable of customerArray
 * @param $customerArray customer
 */
function customerTableRowEditFields($customerArray)
{
    tableRowEditTD('name', $customerArray->getName(), $customerArray->getName());
    tableRowEditTD('surname', $customerArray->getSurname(), $customerArray->getSurname());
    tableRowEditTD('contact_number', $customerArray->getContactNumber(), $customerArray->getContactNumber());
    tableRowEditTD('email', $customerArray->getEmail(), $customerArray->getEmail(), "true", "email");
    tableRowEditTD('sa_id_number', $customerArray->getSaIdNumber(), $customerArray->getSaIdNumber());
    tableRowEditTD('address', $customerArray->getAddress(), $customerArray->getAddress());
}

/** Generates an editable row of customers.
 * @param $customerArray customer
 */
function customerTableRowEditNew($customerArray)
{
    echo "<tr>
                <form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>
                    <td> 
                        " . htmlspecialchars($customerArray->getId()) . "
                    </td>";
    customerTableRowEditFields($customerArray);
    echo "<td>
                <input type='submit' name='newCustomer' value='New Customer'> 
                <input type='submit' name='deleteCustomer' value='delete'>
                <input type='hidden' name='id' value='" . htmlspecialchars($customerArray->getId()) . "'>
            </td>" . "
        </form>
    </tr>";
}




/** Returns the highest id from the customer table. Note to close the connection afterwards.
 *
 */
function getHighestCustID()
{
    if (!isset($conn)) {
        $conn = mysqli_connect("", "", "");
        include('directConnection.php');
    }

    $sql = $conn->query("SELECT id FROM customer ORDER BY id DESC LIMIT 1;");
    $row = mysqli_fetch_assoc($sql);
    if ($row) {
        $row = $row['id'];
    }
    $sql->close();
    return $row;
}