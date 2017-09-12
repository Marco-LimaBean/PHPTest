<?php

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
 * @param $Where string this is the where clause. Use e.g. 1=1 for all results.
 * @return array Customer
 */
function getCustomer($Where)
{
    if (!class_exists("dbConnect")) require("dbConnect.php");
    if (!class_exists("customer")) require("customer.php");
    $dbConnect = new dbConnect();
    $results = $dbConnect->fetch("SELECT * FROM customer WHERE " . $Where);

    $customer = array();

    foreach ($results as $value) {
        array_push($customer,
            new Customer($value['name'], $value['surname'], $value['contact_number'],
                $value['email'], $value['sa_id_number'], $value['address'], $value['id']));
    }
    return $customer;
}

///** Updates a customer's details. Note that the DB connection variable called $conn must be initialized before calling this function.
// * @param $name
// * @param $surname
// * @param $contact_number
// * @param $email
// * @param $sa_id_number
// * @param $address
// * @param bool|number $id number Note that the default is false
// */
//function updateCustomer($name, $surname, $contact_number, $email, $sa_id_number, $address, $id = false)
//{
//    if (!isset($dbConnect)) {
//        if (!class_exists("dbConnect")) include('dbConnect.php');
//        $dbConnect = new dbConnect();
//    }
//
//
//    if (!$id) { //add new customer
//
//        $sql = $conn->prepare("INSERT INTO customer (name, surname, contact_number, email, sa_id_number, address) VALUES (?,?,?,?,?,?)");
//        $sql->bind_param("ssssss", $name, $surname, $contact_number, $email, $sa_id_number, $address);
//    } else {
//        $sql = $conn->prepare("UPDATE customer SET name = ?, surname = ?, contact_number = ?, email = ?, sa_id_number = ?, address = ? WHERE id = ?;");
//        $sql->bind_param("sssssss", $id, $name, $surname, $contact_number, $email, $sa_id_number, $address);
//    }
//    $sql->execute();
//    $sql->close();
//}

/** Either updates or creates a new customer based on the given customer array.
 * @param $customer customer
 * @param bool $isNew default is false;
 */
function updateCustomer($customer, $isNew = false)
{
    if (!isset($dbConnect)) {
        if (!class_exists("dbConnect")) include('dbConnect.php');
        $dbConnect = new dbConnect();
    }


    if($isNew) $dbConnect->insert("customer", $customer);
    else $dbConnect->update("customer", $customer, "id = " . $customer->getId());
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
    echo "<tr>
            <td>" . htmlspecialchars($customerArray->getId()) . "</td>" . "
            <td>" . htmlspecialchars($customerArray->getName()) . "</td>" . "
            <td>" . htmlspecialchars($customerArray->getSurname()) . "</td>" . "
            <td>" . htmlspecialchars($customerArray->getContactNumber()) . "</td>" . "
            <td>" . htmlspecialchars($customerArray->getEmail()) . "</td>" . "
            <td>" . htmlspecialchars($customerArray->getSaIdNumber()) . "</td>" . "
            <td>" . htmlspecialchars($customerArray->getAddress()) . "</td>" . "
            <td> <a href='?id=" . htmlspecialchars($customerArray->getId()) . "'>edit</a> 
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
                    </td>" . "
                    <td> 
                        <input name='name' value='" . htmlspecialchars($customerArray->getName()) . "' placeholder='" . htmlspecialchars($customerArray->getName()) . "' required> 
                    </td>" . "
                    <td> 
                        <input name='surname' value='" . htmlspecialchars($customerArray->getSurname()) . "' placeholder='" . htmlspecialchars($customerArray->getSurname()) . "' required> 
                    </td>" . "
                    <td> 
                        <input name='contact_number' value='" . htmlspecialchars($customerArray->getContactNumber()) . "' placeholder='" . htmlspecialchars($customerArray->getContactNumber()) . "' required> 
                    </td>" . "
                    <td> 
                        <input name='email' value='" . htmlspecialchars($customerArray->getEmail()) . "' placeholder='" . htmlspecialchars($customerArray->getEmail()) . "' type='email' required> 
                    </td>" . "
                    <td> 
                        <input name='sa_id_number' value='" . htmlspecialchars($customerArray->getSaIdNumber()) . "' placeholder='" . htmlspecialchars($customerArray->getSaIdNumber()) . "' required> 
                    </td>" . "
                    <td> 
                        <input name='address' value='" . htmlspecialchars($customerArray->getAddress()) . "' placeholder='" . htmlspecialchars($customerArray->getAddress()) . "' required>  
                    </td>" . "<td> 
                        <input type='submit' name='updateCustomer' value='save'> 
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
    if ($row = mysqli_fetch_assoc($sql)) {
        $sql->close();
        return $row['id'];
    } else {
        $sql->close();
        die("Failed to create a valid id");
    }
}