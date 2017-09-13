<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/13/2017
 * Time: 4:00 PM
 */

include_once('functionsCustomer.php');
include_once('functionsMain.php');

if (isset($_POST['customerID'], $_POST['customerPassword']) && is_string($_POST['customerID'])
    && is_string($_POST['customerPassword'])) {
    $_SESSION['loggedIn'] = login($_POST['customerID'], $_POST['customerPassword']);
    if (!$_SESSION['loggedIn']) unset($_SESSION['loggedIn']);
    refresh();
}

include('html/loginForm.html');