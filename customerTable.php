<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/8/2017
 * Time: 2:21 PM
 */

include('dbConnect.php');
include_once('functionsCustomer.php');

//page arrays
$_SESSION['customer'] = array();
$dbConnect = new dbConnect();

//GET ALL CUSTOMERS
$_SESSION['customer'] = getCustomer("1=1");

//CREATE TABLE FOR CUSTOMERS
?>
    <table style="width:100%">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>surname</th>
            <th>contact_number</th>
            <th>email</th>
            <th>sa_id_number</th>
            <th>address</th>
            <th>Actions</th>
            <?php

            ////dynamic table headings
            //$sql = $conn->query("SHOW COLUMNS FROM customer");
            //while($row = mysqli_fetch_assoc($sql)){
            //    echo "<th>" . $row['Field'] . "</th>";
            //}

            //end of table headings
            ?>
        </tr>
        <?php

        foreach ($_SESSION['customer'] as $key => $value) {
                if(isset($_GET['id'])) {
                    //fixes bug in regards to there being both a $_GET['id'] and a $_SESSION['userEditing'] causing two rows to be edited.
                    $_SESSION['userEditing'] = $_GET['id'];
                }

                if (isset($_SESSION['userEditing']) && $_SESSION['userEditing'] == $value->getId()) {
                    $_SESSION['userEditing'] = $value->getId();
                    customerTableRowEdit($value);
                } else {
                    customerTableRow($value);
                }
            }

        if (isset($_POST['addCustomer'])) {
            unset($_SESSION['userEditing'], $_GET['id'], $_POST['addCustomer']);
            $addCustID = getHighestCustID() + 1;
            customerTableRowEdit(new Customer());
        }


//        $sql = $conn->query("SELECT * FROM customer;");
//
//
//        while ($row = mysqli_fetch_assoc($sql)) {
//
//
//
//            if(isset($_GET['id'])) {
//                //fixes bug in regards to there being both a $_GET['id'] and a $_SESSION['userEditing'] causing two rows to be edited.
//                $_SESSION['userEditing'] = $_GET['id'];
//            }
//
//            if (isset($_SESSION['userEditing']) && $_SESSION['userEditing'] == $row['id']) {
//                $_SESSION['userEditing'] = $row['id'];
//                customerTableRowEdit($row['id'], $row['name'], $row['surname'], $row['contact_number'], $row['email'], $row['sa_id_number'], $row['address']);
//            } else {
//                customerTableRow($row['id'], $row['name'], $row['surname'], $row['contact_number'], $row['email'], $row['sa_id_number'], $row['address']);
//            }
//        }
//
//        if (isset($_POST['addCustomer'])) {
//            unset($_SESSION['userEditing'], $_GET['id'], $_POST['addCustomer']);
//            $addCustID = getHighestCustID() + 1;
//            customerTableRowEdit($addCustID);
//        }


        ?>
    </table>
    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <input name="addCustomer" type="submit" value="Add a customer">
    </form>
<?php

//if user clicks the delete hyperlink, query string of ?id=num&delete=true;
if(isset($_GET['id'], $_GET['delete']) || isset($_SESSION['userEditing'], $_POST['deleteCustomer'])){
    $deleteID = (isset($_GET['id']) ? $_GET['id'] : $_SESSION['userEditing']);
    $delete = (isset($_GET['delete']) ? $_GET['delete'] : $_POST['deleteCustomer']);
    if(is_numeric($deleteID) && $delete === "TRUE"){
        echo "checks passed";
        echo $delete;

        $message = NULL;

        if(deleteCustomer($_GET['id'])){
            $message = "Customer has been deleted";

        }else{
            $message = "There was an error deleting the customer.";
        }

        jsAlert($message);
        redirectQuery("id=" . $_GET['id']);

    }else{
        echo "An error occurred, please use a website GUI";
    }

}


//if the save button is clicked to update the customer
if (isset($_POST['updateCustomer'])) {
    //check if the user submitted all variables (nothing empty)
    if (isset($_POST['id'], $_POST['name'], $_POST['surname'], $_POST['contact_number'], $_POST['email']
        , $_POST['sa_id_number'], $_POST['address'])) {

        do {
            /*
             * SCRUBBING USER DATA
             */

            //check if the email is valid
            $invalidError = "Please enter a valid email";
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                //not a valid e-mail, fall back to the alert
                break;
            }

            //check if the sa_id_number is valid
            $invalidError = "Please enter a valid South African ID Number";
            if (!validSAID($_POST['sa_id_number'])) {
                //not a valid e-mail, fall back to the alert
                break;
            }

            //set control variable to null for invalid data catch to not trigger
            $invalidError = NULL;

            /*
             * END OF SCRUBBING USER DATA
             */

            if ($_POST['updateCustomer'] == "Save") {
                updateCustomer(in_array($_SESSION['userEditing'], $_SESSION['customer']->getId()));
//
//                updateCustomer($_POST['name'], $_POST['surname'], $_POST['contact_number'], $_POST['email'],
//                    $_POST['sa_id_number'], $_POST['address'], $_POST['id']);
//                //reset the session variable.
                unset($_SESSION['userEditing']);
            } else {
                updateCustomer(new Customer($_POST['name'], $_POST['surname'], $_POST['contact_number'], $_POST['email'],
                    $_POST['sa_id_number'], $_POST['address']), true);
                echo "Else update customer called";
                //reset the session variable.
                unset($_SESSION['userEditing']);
            }

//            //can't use header as header information has already been sent... maybe output buffering?
//            header("Refresh: 0");
            refresh();

        } while (false);
        //if the above loop terminated due to error:
        if ($invalidError !== NULL) {
            jsAlert($invalidError);
            //load the correct page
        }

    } else {
        jsAlert("Please enter valid details or use the website.");
    }

    //check if all user-submitted variables are valid
}
