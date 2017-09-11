<?php
/** Updates a customer's details. Note that the DB connection variable called $conn must be initialized before calling this function.
 * @param $id
 * @param $name
 * @param $surname
 * @param $contact_number
 * @param $email
 * @param $sa_id_number
 * @param $address
 */
function updateCustomer($id, $name, $surname, $contact_number, $email, $sa_id_number, $address){
    if(!isset($conn)){
        $conn = mysqli_connect("", "", "");
        include('dbConnect.php');
    }

    $sql = $conn->prepare("UPDATE customer SET name = ?, surname = ?, contact_number = ?, email = ?, sa_id_number = ?, address = ? WHERE id = ?;");
    $sql->bind_param("sssssss", $id, $name, $surname, $contact_number, $email, $sa_id_number, $address);
    $sql->execute();
    $sql->close();
}

/** Insert a customer's details. Note that the DB connection variable called $conn must be initialized before calling this function.
 * @param $name
 * @param $surname
 * @param $contact_number
 * @param $email
 * @param $sa_id_number
 * @param $address
 */
function addCustomer($name, $surname, $contact_number, $email, $sa_id_number, $address){
    if(!isset($conn)){
        $conn = mysqli_connect("", "", "");
        include('dbConnect.php');
    }

    $sql = $conn->prepare("INSERT INTO customer (name, surname, contact_number, email, sa_id_number, address) VALUES (?,?,?,?,?,?)");
    $sql->bind_param("ssssss", $name, $surname, $contact_number, $email, $sa_id_number, $address);
    $sql->execute();
    $sql->close();
}


/** Function is for a row of
 * @param $id
 * @param $name
 * @param $surname
 * @param $contact_number
 * @param $email
 * @param $sa_id_number
 * @param $address
 */
function customerTableRow($id, $name, $surname, $contact_number, $email, $sa_id_number, $address){
    echo "<tr>
            <td>" . htmlspecialchars($id) . "</td>" . "
            <td>" . htmlspecialchars($name) . "</td>" . "
            <td>" . htmlspecialchars($surname) . "</td>" . "
            <td>" . htmlspecialchars($contact_number) . "</td>" . "
            <td>" . htmlspecialchars($email) . "</td>" . "
            <td>" . htmlspecialchars($sa_id_number) . "</td>" . "
            <td>" . htmlspecialchars($address) . "</td>" . "
            <td> <a href='?id=" . htmlspecialchars($id) . "'>edit</a> </td>" . "
         </tr>";
}

function customerTableRowEdit($id, $name, $surname, $contact_number, $email, $sa_id_number, $address){
    echo "<tr>
                <form action='". htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>
                    <td> 
                        " . htmlspecialchars($id) . "
                    </td>" . "
                    <td> 
                        <input name='name' value='" . htmlspecialchars($name) . "' placeholder='" . htmlspecialchars($name) . "' required> 
                    </td>" . "
                    <td> 
                        <input name='surname' value='" . htmlspecialchars($surname) . "' placeholder='" . htmlspecialchars($surname) . "' required> 
                    </td>" . "
                    <td> 
                        <input name='contact_number' value='" . htmlspecialchars($contact_number) . "' placeholder='" . htmlspecialchars($contact_number) . "' required> 
                    </td>" . "
                    <td> 
                        <input name='email' value='" . htmlspecialchars($email) . "' placeholder='" . htmlspecialchars($email) . "' type='email' required> 
                    </td>" . "
                    <td> 
                        <input name='sa_id_number' value='" . htmlspecialchars($sa_id_number) . "' placeholder='" . htmlspecialchars($sa_id_number) . "' required> 
                    </td>" . "
                    <td> 
                        <input name='address' value='" . htmlspecialchars($address) . "' placeholder='" . htmlspecialchars($address) . "' required>  
                    </td>" . "<td> 
                        <input type='submit' name='updateCustomer' value='save'> 
                        <input type='hidden' name='id' value='" . htmlspecialchars($id) . "'>
                    </td>" . "
                </form>
              </tr>";
}


/** Returns the highest id from the customer table. Note to close the connection afterwards.
 *
 */
function getHighestCustID(){
    if(!isset($conn)){
        $conn = mysqli_connect("", "", "");
        include('dbConnect.php');
    }

    $sql = $conn->query("SELECT id FROM customer ORDER BY id DESC LIMIT 1;");
    if($row = mysqli_fetch_assoc($sql)) {
        $sql->close();
        return $row['id'];
    }else{
        $sql->close();
        die("Failed to create a valid id");
    }
}