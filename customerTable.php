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

        $_SESSION['customerIDList'] = array();

        foreach ($_SESSION['customer'] as $key => $customer) {
            /** @var customer $customer */
            array_push($_SESSION['customerIDList'], $key);
            if (isset($_GET['id'])) {
                //fixes bug in regards to there being both a $_GET['id'] and a $_SESSION['userEditing'] causing two rows to be edited.
                $_SESSION['userEditing'] = $_GET['id'];
            }


            if (isset($_SESSION['userEditing']) && $_SESSION['userEditing'] == $customer->getId()) {
                $_SESSION['userEditing'] = $customer->getId();
                customerTableRowEdit($customer);
            } else {
                customerTableRow($customer);
            }
        }

        if (isset($_POST['addCustomer'])) {
            //stop the user from editing other things:
            unset($_SESSION['userEditing'], $_GET['id'], $_POST['addCustomer']);
            $addCustID = getHighestCustID() + 1;
            //save which one he is editing now:
            $_SESSION['userEditing'] = $addCustID;
            customerTableRowEditNew(new Customer());
        }

        ?>
    </table>
    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <input name="addCustomer" type="submit" value="Add a customer">
    </form>
<?php

//if user clicks the delete hyperlink, query string of ?id=num&delete=true;
if (isset($_GET['id'], $_GET['delete']) || isset($_SESSION['userEditing'], $_POST['deleteCustomer'])) {
    $deleteID = (isset($_GET['id']) ? $_GET['id'] : $_SESSION['userEditing']);
    $delete = (isset($_GET['delete']) ? $_GET['delete'] : $_POST['deleteCustomer']);
    if (is_numeric($deleteID) && $delete === "TRUE") {
        $message = NULL;

        if (deleteCustomer($_GET['id'])) {
            $message = "Customer has been deleted";
        } else {
            $message = "There was an error deleting the customer.";
        }

        jsAlert($message);
        redirectQuery("id=" . $_GET['id']);

    } else {
        echo "An error occurred, please use a website GUI";
    }
}

//if the save button is clicked to update the customer
if (isset($_POST['updateCustomer']) || isset($_POST['newCustomer'])) {
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

            $updateCustomer = new Customer($_POST['name'], $_POST['surname'], $_POST['contact_number'], $_POST['email'],
                $_POST['sa_id_number'], $_POST['address'], $_SESSION['userEditing']);

            //in case it's a new customer:
            if (isset($_POST['newCustomer']) && $_POST['newCustomer'] == 'New Customer') {
                $updateCustomer->setId(FALSE);
                $_POST['updateCustomer'] = "save";
            }

            if ($_POST['updateCustomer'] == "save") {
                if (!updateCustomer($updateCustomer)) {
                    //if it failed to update the customer.
                    jsAlert("Failed to update customer, have you already submitted the form? 
                    please contact your WebAdmin (CODE: 1004)");
                }
                unset($_SESSION['userEditing']);
            }
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
}
